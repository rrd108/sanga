<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\String;

use Cake\Core\Configure;

use Google_Client;
use Google_Http_Request;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {
	
	public $helpers = ['Number'];
		
	public function isAuthorized($user = null) {
        return true;
    }

	public function search(){
		$contact = $this->Contacts->newEntity($this->request->data);
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"']);
		foreach($query as $row){
			$label = $this->createHighlight($row->name) .
					$this->createHighlight($row->contactname);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		$this->set('result', $result);
		$this->set('contact', $contact);
	}

	public function quicksearch(){
		$contact = $this->Contacts->newEntity($this->request->data);
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname', 'email', 'phone'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['email LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['phone LIKE "%'.$this->request->query('term').'%"']);
		//debug($query);
		foreach($query as $row){
			$label = $this->createHighlight($row->name) .
					$this->createHighlight($row->contactname) .
					$this->createHighlight($row->email) .
					$this->createHighlight($row->phone);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		//debug($result);die();
		$this->set('result', $result);
		$this->set('contact', $contact);
	}

	private function createHighlight($value = null){
		if($value && strpos(strtolower($value), $this->request->query('term')) !== false){
			$highlight = array('format' => '<span class="b i">\1</span>');
			return String::highlight($value, $this->request->query('term'), $highlight) . ' ';
		}
	}

	//cím adatok lekérdezése a mapon való megjelenéshez
	public function showmap(){
		$result = $this->Contacts->find()
				->contain(['Zips'])
				->select(['Contacts.lat', 'Contacts.lng', 'Zips.zip', 'Zips.name'])
				->where('Contacts.lat != 0')
				->toArray();
		//debug($result);
		$this->set('result', $result);
	}
	
	//mindenféle lekérdezések
	public function searchquery(){
		
		if($this->request->data){
			/*
			 debug($this->request->data);
			[
				'_zip_id' => '200',
				'zip_id' => '162',
				'area' => '15',
				'_group_id' => 'Seva-puja',
				'group_id' => '3'
			]
			*/
			
			$center = $this->Contacts->Zips->find()
					->select(['lat', 'lng'])
					->where(['id' => $this->request->data['zip_id']])
					;
			$cent = $center->toArray();
			
			$expr = $center->newExpr()->add('(3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$cent[0]->lat.
											' - abs( Contacts.lat ) ) * pi( ) /180 /2 ) , 2 ) + COS( '.$cent[0]->lat.
											' * pi( ) /180 ) * COS( abs( Contacts.lat ) * pi( ) /180 ) * POWER( SIN( ( '.
											$cent[0]->lng.' - Contacts.lng ) * pi( ) /180 /2 ) , 2 ) ) ))');
			
			$result = $this->Contacts->find()
					->contain(['Zips', 'Groups'])
					->select(['Contacts.name', 'Zips.zip', 'Zips.name', 'distance' => $expr])
					->where(['active' => true/*,
							 'distance' => $expr*/])
					->matching('Groups', function($q){
						return $q->where(['Groups.id' => $this->request->data['group_id']]);
						})
					->having(['distance <=' => $this->request->data['area']])
					->order(['distance' => 'ASC']);
			$this->set('result', $result);
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$_myGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id')])->toArray();
		foreach($_myGroups as $mg){
			$groupIds[] = $mg->id;
		}

		$myContacts = $this->Contacts->find('mine', ['User.id' => $this->Auth->user('id')])
				->select(['Contacts.id']);
		$inmygroupsContacts = $this->Contacts->find('inGroups', ['groupIds' => $groupIds])
				->select(['Contacts.id']);

		$contacts = $this->Contacts->find()
								->select(['Contacts.id', 'Contacts.name', 'Contacts.contactname',
										  'Contacts.address', 'Contacts.phone',
										  'Zips.id', 'Zips.zip', 'Zips.name'])
								->contain(['Zips', 'Users', 'Groups'])
								->orWhere(['Contacts.id IN ' => $inmygroupsContacts])
								->orWhere(['Contacts.id IN ' => $myContacts]);
		$this->set('contacts', $this->paginate($contacts));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$id = $id ? $id : $this->request->data['name'];
		$contact = $this->Contacts->get($id, [
			'contain' => ['Zips', 'Contactsources', 'Groups', 'Skills', 'Users', 'Histories']
		]);
		$this->set('contact', $contact);
		
		$family = $this->Contacts->find()
				->where(['family_id' => $contact->family_id]);
		$this->set('family', $family);
		
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Events', 'Units', 'Groups']
		];
		$histories = $this->Contacts->Histories->find()
				->where(['contact_id' => $id])
				->order(['Histories.date' => 'DESC']);
		$this->set('histories', $this->paginate($histories));

		$accessibleGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id'), 'shared' => true]);
		$users = $this->Contacts->Users->find();
		$this->set(compact('accessibleGroups', 'users'));
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contact = $this->Contacts->newEntity($this->request->data);
		if($this->request->data){
			//debug($this->request->data);
			/*'skills' => [
				'_ids' => [
					(int) 0 => '1',			//found in skills, this is the id
					(int) 1 => '~könyvelő'		//starts with "~" this is a new skill (or fast typer problem)
				]]
			*/
			if(is_array($this->request->data['skills']['_ids'])){
				foreach($this->request->data['skills']['_ids'] as $i => $skill){
					if(mb_substr($skill, 0,1) == '~'){
						$skill = ltrim($skill, '~');
						$contact['skills'][] = $this->Contacts->Skills->newEntity(['name' => $skill]);
					}
				}
			}
			
			if($this->request->data['family_id']){
				//$this->request->data['family_id'] here means the other family member's id, NOT the family id
				$familyMember = $this->Contacts->find()
						->select(['family_id'])
						->where(['id' => $this->request->data['family_id']])
						->first();
				//debug($familyMember);
				if(isset($familyMember->family_id)){
					//to choosen family member already has a family_id
					$contact->family_id = $familyMember->family_id;
				}
				else{
					//this is a new family definition
					//we should save this to the other family member
					$familyMember = $this->Contacts->get($this->request->data['family_id']);
					$familyMember->family_id = $contact->family_id = uniqid();
					$this->Contacts->save($familyMember);
				}
			}
		//die();
		}
		if ($this->request->is('post')) {
			$contact->loggedInUser = $this->Auth->user('id');
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				//debug($contact->errors());
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list', ['idField' => 'id', 'valueField' => 'full_zip']);
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id'), 'shared' => true]);
		$skills = $this->Contacts->Skills->find('list');
		$users = $this->Contacts->Users->find();
		$this->set(compact('contact', 'zips', 'contactsources', 'groups', 'skills', 'users'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contact = $this->Contacts->get($id, [
			'contain' => ['Groups', 'Skills', 'Users', 'Zips']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contact = $this->Contacts->patchEntity($contact, $this->request->data);
			$contact->loggedInUser = $this->Auth->user('id');
			$saved = $this->Contacts->save($contact);
			if ($saved) {
				$message = __('The contact has been saved.');
				if($this->request->is('ajax')){
					$result = ['save' => $message];
				}
				else{
					$this->Flash->success($message);
					return $this->redirect(['action' => 'view', $id]);
				}
			} else {
				$message = __('The contact could not be saved. Please, try again.');
				if($this->request->is('ajax')){
					$result = ['save' => $message];
				}
				else{
					$this->Flash->error($message);
				}
			}
		}
		if($this->request->is('ajax')){
			$this->set(compact('result'));
			return;
		}
		$zips = $this->Contacts->Zips->find('list');
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$skills = $this->Contacts->Skills->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'zips', 'contactsources', 'groups', 'skills', 'users'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contact = $this->Contacts->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Contacts->delete($contact)) {
			$this->Flash->success('The contact has been deleted.');
		} else {
			$this->Flash->error('The contact could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
	
	public function checkDuplicates(){
		$this->Contacts->checkDuplicatesOnGeo();
		/*foreach($this->Contacts->checkDuplicatesOnPhone() as $q){
			debug($q->toArray());
		}*/
		//$this->Contacts->checkDuplicatesOnEmail();
		//$this->Contacts->checkDuplicatesOnBirth();
		//$this->Contacts->checkDuplicatesOnNames();
	}
	
	public function editGroup($id = null){
		if ($this->request->is('post') && $this->request->is('ajax')) {
			$contact = $this->Contacts->get($id, ['contain' => ['Groups']]);
			foreach($contact->groups as $group){
				$this->request->data['groups']['_ids'][] = $group->id;
			}
			$contact->loggedInUser = $this->Auth->user('id');
			$this->Contacts->patchEntity($contact, $this->request->data);
			if($this->Contacts->save($contact)){
				$result = ['saved' => true];
			}
			else{
				$result = ['saved' => false];
			}
			$this->set(compact('result'));
		}
	}

	public function removeGroup($id = null){
		if ($this->request->is('post') && $this->request->is('ajax')) {
			$contact = $this->Contacts->get($id, ['contain' => ['Groups']]);
			$groups = [];
			foreach($contact->groups as $group){
				if($group->id != $this->request->data['groups']['_ids'][0]){
					$groups[] = $group->id;
				}
			}
			$this->request->data['groups']['_ids'] = $groups;
			$contact->loggedInUser = $this->Auth->user('id');
			$this->Contacts->patchEntity($contact, $this->request->data);
			if($this->Contacts->save($contact)){
				$result = ['saved' => true];
			}
			else{
				$result = ['saved' => false];
			}
			$this->set(compact('result'));
		}
	}
	
	public function google(){
		require_once('../vendor/google/apiclient/src/Google/Client.php');
		$client = new Google_Client();
		$client->setClientId(Configure::read('Google.clientId'));
		$client->setClientSecret(Configure::read('Google.clientSecret'));
		$client->setRedirectUri(Configure::read('Google.redirectUri'));

		$client->setScopes("http://www.google.com/m8/feeds/");
		
		//callback: saves access token and (at the very first time) refesh token
		if (isset($this->request->query['code'])) {
			$client->authenticate($this->request->query['code']);
			$this->request->session()->write('access_token', $client->getAccessToken());
			$this->request->session()->write('refresh_token', $client->getRefreshToken());
			//redirect
			$this->redirect(['action' => 'google']);
		}
		//callback end
	
		if ($this->request->session()->read('access_token')) {
			$client->setAccessToken($this->request->session()->read('access_token'));
			//https://developers.google.com/google-apps/contacts/v3/reference#Parameters
			$req = new Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full'.
										   '?alt=json&max-results=20&start-index=500');
			$val = $client->getAuth()->authenticatedRequest($req);
			$gContacts = json_decode($val->getResponseBody());
			if(isset($gContacts->error)){
				$this->Flash->error($gContacts->error->message);
				if($gContacts->error->code == 401){		//Invalid Credentials The access token expired or invalid
					//get a new access token with refresh token
					$client->refreshToken(Configure::read('Google.refreshToken'));
					$this->request->session()->write('access_token', $client->getAccessToken());
					$this->redirect(['action' => 'google']);
				}
			}
			else{
				//https://developers.google.com/gdata/docs/2.0/elements?csw=1#gdContactKind
				foreach($gContacts->feed->entry as $entry){
					//debug($entry);
					
					//$gId = str_replace('http://www.google.com/m8/feeds/contacts/default/base/', '', $entry->id->{'$t'});
					$gId = substr(strrchr($entry->id->{'$t'}, '/'), 1);
					//debug($gId);
					//get photo bytes
					$req = new Google_Http_Request('https://www.google.com/m8/feeds/photos/media/default/' . $gId);
					$val = $client->getAuth()->authenticatedRequest($req);
					$photo = $val->getResponseBody();
					/*$photoErrors = ['Invalid request URI', 'Photo not found'];
					$photo = in_array($photoRes, $photoErrors) ? null : $photoRes;*/
					
					$contacts[] = ['gId' => $gId,
								   'name' => isset($entry->title->{'$t'}) ? $entry->title->{'$t'} : '',
								   'updated' => $entry->updated->{'$t'},
								   'email' => isset($entry->{'gd$email'}) ? $entry->{'gd$email'} : '',
								   'phone' => isset($entry->{'gd$phoneNumber'}) ? $entry->{'gd$phoneNumber'} : '',
								   'address' => isset($entry->{'gd$postalAddress'}) ? $entry->{'gd$postalAddress'} : '',
								   'photo' =>	$photo	//http://stackoverflow.com/questions/9439076/google-contact-api-picture-data-returns-data-but-i-dont-know-how-to-display-it
								   ];
				}
				/*
				id => object(stdClass) {
					$t => 'http://www.google.com/m8/feeds/contacts/rrd%40108.hu/base/223576c8e726539'
				}
				
				title->$t
				
				updated => object(stdClass) {
					$t => '2014-10-08T20:00:19.868Z'
				}
		
				gd$email => [
					(int) 0 => object(stdClass) {
						address => 'bosos@gmail.com'
						primary => 'true'
						rel => 'http://schemas.google.com/g/2005#home'
					},
					(int) 1 => object(stdClass) {
						address => 'Laszlo.Bosos@msc.com'
						rel => 'http://schemas.google.com/g/2005#other'
					}
				]
				
				gd$phoneNumber => [
					(int) 0 => object(stdClass) {
						rel => 'http://schemas.google.com/g/2005#mobile'
						primary => 'true'
						uri => 'tel:+36-30-999-9999'
						$t => '+36 30 999 9999'
					}
				]
				gd$postalAddress => [
					(int) 0 => object(stdClass) {
						rel => 'http://schemas.google.com/g/2005#home'
						$t => 'Petneházy u. 1. Budapest 1009'
					}
				]
				
				gContact$groupMembershipInfo => [
					(int) 0 => object(stdClass) {
						deleted => 'false'
						href => 'http://www.google.com/m8/feeds/groups/rrd%40108.hu/base/12f7abz8f4a01ac'
					},
				*/
				$this->set('contacts', $contacts);
			}
		} else {
			$client->setAccessType('offline');		//we want to get refresh token also
			$this->set('authUrl', $client->createAuthUrl());
		}
	
	}
}