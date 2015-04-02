<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\String;

use Cake\Core\Configure;

use Google_Client;
use Google_Http_Request;

use Cake\Network\Exception\NotImplementedException;

use Cake\Network\Email\Email;

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
				->select(['id', 'contactname', 'legalname'])
				->where(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['legalname LIKE "%'.$this->request->query('term').'%"']);
		foreach($query as $row){
			$label = $this->createHighlight($row->contactname) .
					$this->createHighlight($row->legalname);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		$this->set('result', $result);
		$this->set('contact', $contact);
	}

	private function createHighlight($value = null){
		if($value && strpos(strtolower($value), $this->request->query('term')) !== false){
			$highlight = array('format' => '<span class="b i">\1</span>');
			return String::highlight($value, $this->request->query('term'), $highlight) . ' ';
		} else {
			return $value;
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
			
			// debug($this->request->data);
			/*[
				'name' => '',
				'xzip' => '2000 Szentendre',
				'zip_id' => '162',
				'area' => '40',
				'group_id' => ''
			]
			*/
			
			$center = $this->Contacts->Zips->find()
					->select(['lat', 'lng'])
					->where(['id' => $this->request->data['zip_id']]);
			$cent = $center->toArray();
			
			$expr = $center->newExpr()->add('(3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$cent[0]->lat.
											' - abs( Contacts.lat ) ) * pi( ) /180 /2 ) , 2 ) + COS( '.$cent[0]->lat.
											' * pi( ) /180 ) * COS( abs( Contacts.lat ) * pi( ) /180 ) * POWER( SIN( ( '.
											$cent[0]->lng.' - Contacts.lng ) * pi( ) /180 /2 ) , 2 ) ) ))');
			
			$result = $this->Contacts->find()
					->contain(['Zips'])
					->select(['Contacts.name', 'Zips.zip', 'Zips.name', 'distance' => $expr])
					->where(['active' => true])
					->having(['distance <=' => $this->request->data['area']])
					->order(['distance' => 'ASC']);
			
			if ($this->request->data['group_id']){
					$result->matching('Groups', function($q){
						return $q->where(['Groups.id' => $this->request->data['group_id']]);
						});
			}
			$this->set('result', $result);
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$contain = [];
		$select = $this->Contacts->Users->Settings
				->find()
				->where(['user_id' => $this->Auth->user('id'),
						 'name' => 'Contacts/index'])
				->first();
		$selected = [];
		if ( empty($select)) {
			$select = ['Contacts.contactname', 'Contacts.legalname', 'Contacts.phone', 'Contacts.email'];
			$selected = ['contactname' => 1, 'legalname' => 1, 'phone' => 1, 'email' => 1];
		} else {
			$select = unserialize($select->value);
			//set the request->data array for the view to autofill the settings form
			foreach ($select as $i => $name) {
				$selected[str_replace('Contacts.', '', $name)] = 1;
				
				if ($name == 'Contacts.zip_id') {
					$select[] = 'Zips.id';
					$select[] = 'Zips.zip';
					$select[] = 'Zips.name';
					$contain[] = 'Zips';
				}
				if ($name == 'Contacts.workplace_zip_id') {
					$select[] = 'WorkplaceZips.id';
					$select[] = 'WorkplaceZips.zip';
					$select[] = 'WorkplaceZips.name';
					$contain[] = 'WorkplaceZips';
				}
				if ($name == 'Contacts.contactsource_id') {
					$select[] = 'Contactsources.id';
					$select[] = 'Contactsources.name';
					$contain[] = 'Contactsources';
				}
				if ($name == 'Contacts.users') {
					unset($select[$i]);
					$contain[] = 'Users';
				}
				if ($name == 'Contacts.skills') {
					unset($select[$i]);
					$contain[] = 'Skills';
				}
				if ($name == 'Contacts.groups') {
					unset($select[$i]);
					$contain[] = 'Groups';
				}
			}
		}
		$this->request->data = $selected;
		$_myGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id')])->toArray();
		foreach($_myGroups as $mg){
			$groupIds[] = $mg->id;
		}

		$myContacts = $this->Contacts->find('ownedBy', ['User.id' => $this->Auth->user('id')])
				->select(['Contacts.id']);
		$inmygroupsContacts = $this->Contacts->find('inGroups', ['groupIds' => $groupIds])
				->select(['Contacts.id']);

		array_unshift($select, 'Contacts.sex');
		array_unshift($select, 'Contacts.id');
		//debug($select);
		$contacts = $this->Contacts->find()
								->select($select)
								->contain($contain)
								->where(['Contacts.id IN ' => $myContacts])
								->orWhere(['Contacts.id IN ' => $inmygroupsContacts])
								->order(['Contacts.contactname' => 'ASC']);/*
								->first()
								->toArray();
		debug($contacts); die();*/
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
		if ( ! $this->Contacts->isAccessible($id, $this->Auth->user('id'))) {

			$contactPersons = $this->Contacts->get($id, ['contain' => ['Users']]);
			$this->set('contactPersons', $contactPersons);

			$this->Flash->error(__('Permission deined'));
			$this->render();
		}
		$contact = $this->Contacts->get($id, [
			'contain' => ['WorkplaceZips', 'Zips', 'Contactsources', 'Groups', 'Skills', 'Users', 'Histories']
		]);
		//debug($contact);die();
		$this->set('contact', $contact);
		
		$family = $this->Contacts->find()
				->where(['family_id' => $contact->family_id]);
		$this->set('family', $family);
		
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Events', 'Units', 'Groups']
		];
		$histories = $this->Contacts->Histories->find()
				->where(['contact_id' => $id])
				->order(['Histories.date' => 'DESC', 'Histories.id' => 'DESC']);
		$this->set('histories', $this->paginate($histories));
		
		$finances = $this->Contacts->Histories->find()
				->where(['contact_id' => $id, 'unit_id' => 1])	//TODO: HC id
				->order(['Histories.date' => 'DESC', 'Histories.id' => 'DESC']);
		$this->set('finances', $this->paginate($finances));

		$accessibleGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id'), 'shared' => true]);
		$this->set(compact('accessibleGroups'));
		
		$hasAccess = $this->Contacts->hasAccess($id);
		$this->set(compact('hasAccess'));
	}

	private function patchSkills($contact){
		//debug($this->request->data);die();
			/*'skills' => [
				'_ids' => [
					(int) 0 => '1',			//found in skills, this is the id
					(int) 1 => '~könyvelő'		//starts with "~" this is a new skill (or fast typer problem)
				]]
			*/
		if(isset($this->request->data['skills']) && is_array($this->request->data['skills']['_ids'])){
			foreach($this->request->data['skills']['_ids'] as $i => $skill){
				if(mb_substr($skill, 0,1) == '~'){
					$skill = ltrim($skill, '~');
					$contact->skills[] = $this->Contacts->Skills->newEntity(['name' => $skill]);
				}
			}
		}
		return $contact;
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$this->request->data['email'] = '123';
		$contact = $this->Contacts->newEntity($this->request->data);
		if($this->request->data){
			$contact = $this->patchSkills($contact);
			
			if($this->request->data['family_member_id']){
				$contact->family_id = $this->get_family_id($contact, $this->request->data['family_member_id']);
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

	private function get_family_id($contact, $family_member_id){
		$familyId = null;
		
		if (isset($contact->id)) {		//we are editing an existing contact
			if (isset($contact->family_id)) {		//and she has family_id
				$familyId = $contact->family_id;
			}
		}
		
		//check if the selected member has a family_id
		$familyMember = $this->Contacts->find()
				->select(['id', 'family_id'])
				->where(['id' => $family_member_id])
				->first();
		if(isset($familyMember->family_id)){		//family member already has a family_id
			if ($familyId && $familyMember->family_id && $familyId != $familyMember->family_id) {
				$this->log('Family error: $familyId: ' . $familyId . ', $familyMember->family_id: ' . $familyMember->family_id, 'debug');
				throw new NotImplementedException(__('Two family members are in different families'));
			} else {
				$familyId = $familyMember->family_id;
			}
		}
		
		if(!$familyId) {		//this is a new family definition
			$familyId = uniqid();
		}

		if (!isset($familyMember->family_id)) {
			//we should save the familyid to the other family member also
			$familyMember->family_id = $familyId;
			$this->Contacts->save($familyMember);
		}
		
		return $familyId;
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		if ( ! $this->Contacts->isAccessible($id, $this->Auth->user('id'))) {
			$this->Flash->error(__('Permission deined'));
			$this->render();
		}

		$contact = $this->Contacts->get($id, [
			'contain' => ['Groups', 'Skills', 'Users', 'Zips']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			$contact = $this->Contacts->patchEntity($contact, $this->request->data);
			$contact = $this->patchSkills($contact);

			if(isset($this->request->data['family_member_id'])){
				$contact->family_id = $this->get_family_id($contact, $this->request->data['family_member_id']);
			}

			$contact->loggedInUser = $this->Auth->user('id');
			//debug($contact);die();
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
	
	public function remove_family($id){
		if ($this->request->is('ajax')) {
			$contact = $this->Contacts->get($id);
			$contact->family_id = null;
			if ($this->Contacts->save($contact)) {
				$result = ['save' => __('The contact is removed from this family')];
			} else {
				$result = ['save' => __('The contact could not be removed from this family')];
			}
		$this->set(compact('result'));
		}
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
		$this->Contacts->checkDuplicatesOnPhone();
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
			$group = $this->Contacts->Groups->get($this->request->data['group_id']);
			$this->Contacts->Groups->unlink($contact, [$group]);			
			$result = ['saved' => true,
					   'message' => __('Group membership removed')];
			$this->set(compact('result'));
			$this->set('_serialize', 'result');
		}
	}
	
	public function removeSkill(){
		if ($this->request->is('post') && $this->request->is('ajax')) {
			$contact = $this->Contacts->get($this->request->data['contact_id']);
			$skill = $this->Contacts->Skills->get($this->request->data['skill_id']);
			$this->Contacts->Skills->unlink($contact, [$skill]);			
			$result = ['saved' => true,
					   'message' => __('Skill removed')];
			$this->set(compact('result'));
			$this->set('_serialize', 'result');
		}
	}

	private function google_client(){
		require_once('../vendor/google/apiclient/src/Google/Client.php');
		$client = new Google_Client();
		$client->setClientId(Configure::read('Google.clientId'));
		$client->setClientSecret(Configure::read('Google.clientSecret'));
		$client->setRedirectUri(Configure::read('Google.redirectUri'));
		
		$client->setScopes(['http://www.google.com/m8/feeds/',
							'https://www.googleapis.com/auth/userinfo.email']);
		
		$user = $this->Contacts->Users->get($this->Auth->user('id'));
		
		if (isset($this->request->query['code'])) {
			//google callback: saves access token and (at the very first time) refesh token
			$this->log('Get access (and refresh) token first time', 'debug');
			$client->authenticate($this->request->query['code']);
			$this->request->session()->write('Google.access_token', $client->getAccessToken());
			
			$user->google_contacts_refresh_token = $client->getRefreshToken();
			if ($this->Contacts->Users->save($user)) {
				$this->log('Refresh token saved for the user', 'debug');
			} else {
				$this->log('Refresh token not saved for user: ' . $this->Auth->user('name'), 'debug');
			}
		}

		if ($this->request->session()->read('Google.access_token')) {
			$client->setAccessToken($this->request->session()->read('Google.access_token'));
		}
		
		if ($client->isAccessTokenExpired() && $user->google_contacts_refresh_token) {
			$this->log('Get new access token with refreshToken as it is expired or not available', 'debug');
			$client->refreshToken($user->google_contacts_refresh_token);
			$this->request->session()->write('Google.access_token', $client->getAccessToken());
		}

		return $client;
	}
	
	private function google_getUser($client){
		$req = new Google_Http_Request('https://www.googleapis.com/userinfo/email?alt=json');
		$val = $client->getAuth()->authenticatedRequest($req);
		$googleUser = json_decode($val->getResponseBody());
		//$this->log($googleUser, 'debug');
		/*
		 [data] => stdClass Object(
            [email] => rrd@1108.cc
            [isVerified] => 1))
		*/
		return $googleUser;
	}
	
	public function google($page = 1){
		$client = $this->google_client();
		
		if ($client->getAccessToken()) {
			//https://developers.google.com/google-apps/contacts/v3/reference#Parameters - currently no support for alphabetical order
			
			//in groups url we can not use default, we should give the email address
			$googleUser = $this->google_getUser($client);
			
			$maxResults = 51;
			$startIndex = 1 + $maxResults * $page;
			$req = new Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full'.
										   '?alt=json'.
										   '&group=http://www.google.com/m8/feeds/groups/'.$googleUser->data->email.'/base/6'.
										   '&max-results='.$maxResults.
										   '&start-index='.$startIndex);
			$val = $client->getAuth()->authenticatedRequest($req);
			$gContacts = json_decode($val->getResponseBody());
			//debug($gContacts);
			$contactsTotal = $gContacts->feed->{'openSearch$totalResults'}->{'$t'};

			$this->request->session()->write('Google.totalResults', $gContacts->feed->{'openSearch$totalResults'}->{'$t'});
			if(isset($gContacts->error)){
				$this->Flash->error($gContacts->error->message);
				$this->log('ERROR: ' . $gContacts->error->code . ': ' . $gContacts->error->message, 'debug');
				if($gContacts->error->code == 401){		//Invalid Credentials The access token expired or invalid
					$this->log('Get a new access token with refresh token', 'debug');
					$this->request->session->delete('Google.access_token');
					$this->redirect(['action' => 'google']);
				}
			}
			else{
				$this->log('Get contact data', 'debug');
				//https://developers.google.com/gdata/docs/2.0/elements?csw=1#gdContactKind
				foreach($gContacts->feed->entry as $entry){
					//debug($entry);
					
					$gId = $this->google_getid($entry);
					
					//get photo bytes
					$photo = $this->google_get_photo($gId, $client);
					
					$contacts[] = ['gId' => $gId,
								   'name' => isset($entry->title->{'$t'}) ? $entry->title->{'$t'} : '',
								   'updated' => $entry->updated->{'$t'},
								   'email' => isset($entry->{'gd$email'}) ? $entry->{'gd$email'} : '',
								   'phone' => isset($entry->{'gd$phoneNumber'}) ? $entry->{'gd$phoneNumber'} : '',
								   'address' => isset($entry->{'gd$postalAddress'}) ? $entry->{'gd$postalAddress'} : '',
								   'photo' =>	$photo
								   ];
				}
				$this->set(compact('contacts', 'contactsTotal', 'maxResults', 'page'));
			}
		} else {
			$this->google_connectpage($client);
		}
	}
	
	private function google_getid($entry){
		return substr(strrchr($entry->id->{'$t'}, '/'), 1);
	}
	
	private function google_connectpage($client){
		$this->log('Create connect page', 'debug');
		$client->setAccessType('offline');		//we want to get refresh token also
		$this->set('authUrl', $client->createAuthUrl());
		$this->render('google_connect');
	}
	
	private function google_get_photo($gId, $client){
		$req = new Google_Http_Request('https://www.google.com/m8/feeds/photos/media/default/' . $gId);
		$val = $client->getAuth()->authenticatedRequest($req);
		return $val->getResponseBody();
	}

	public function google_import(){
		if ($this->request->data && $this->request->is('post') && $this->request->is('ajax')) {
			//add contacts person
			$this->request->data['users'] = ['_ids' => [$this->Auth->user('id')]];
			
			if ($this->request->data['address']) {
				$address = $this->formatAddress($this->request->data['address']);
				$this->request->data['zip_id'] = $address['zip_id'];
				$this->request->data['address'] = $address['address'];
			}
			
			$contact = $this->Contacts->newEntity($this->request->data);
			$contact->loggedInUser = $this->Auth->user('id');
			if ($this->Contacts->save($contact)) {
				$result = ['save' => __('The contact has been saved.')];

				//save photos
				$client = $this->google_client();
				$photo = $this->google_get_photo($this->request->data['google_id'], $client);
				if (strlen($photo) > 32) {
					$source = imagecreatefromstring($photo);
					$file = $this->webroot . 'img/contacts/' . $contact->id . '.jpg';
					$success = imagejpeg($source, $file, 100);
					imagedestroy($source);
					$result['photoSave'] = $success ? __('Contact photo saved.') : __('Unable to save contact photo.');
				}
			} else {
				$result = ['save' => __('The contact could not be saved. Please, try again.')];
			}
			$this->set(compact('result'));
		}
	}
	
	public function google_save($id){
		$client = $this->google_client();
		if ($client->getAccessToken()) {
			$googleUser = $this->google_getUser($client);

			$contact = $this->Contacts->get($id, ['contain' => ['Zips' => ['Countries']]]);
			
			$contactEntry = "<atom:entry xmlns:atom='http://www.w3.org/2005/Atom' ".
								"xmlns:gd='http://schemas.google.com/g/2005' ".
								"xmlns:gContact='http://schemas.google.com/contact/2008'>".
							  "\n<atom:category scheme='http://schemas.google.com/g/2005#kind' ".
								"term='http://schemas.google.com/contact/2008#contact'/>";
			
			$contactName = $contact->contactname ? $contact->contactname : $contact->legalname;
			
			$contactEntry .= "\n<gd:name>".
								"<gd:fullName>" . $contactName . "</gd:fullName>".
							  "</gd:name>";
							  
			if($contact->email){
				$contactEntry .= "\n<gd:email rel='http://schemas.google.com/g/2005#work' ".
								"primary='true' ".
								"address='".$contact->email."'/>";
			}
			
			if($contact->phone){
				$contactEntry .= "\n<gd:phoneNumber rel='http://schemas.google.com/g/2005#work' ".
								"primary='true'>".$contact->phone.
								"</gd:phoneNumber>";
			}
		
			if($contact->address){
				$contactEntry .= "\n<gd:structuredPostalAddress ".
								  "rel='http://schemas.google.com/g/2005#work' ".
								  "primary='true'>".
									"<gd:city>".$contact->zip->name."</gd:city>".
									"<gd:street>".$contact->address."</gd:street>".
									"<gd:postcode>".$contact->zip->zip."</gd:postcode>".
									"<gd:country>".$contact->zip->country->name."</gd:country>".
								"</gd:structuredPostalAddress>";
			}
			
			$contactEntry .= "\n<gContact:groupMembershipInfo deleted='false' ".
				"href='http://www.google.com/m8/feeds/groups/".$googleUser->data->email."/base/6' />";	//add to my contacts group
	
			$contactEntry .= "\n</atom:entry>";
			//$this->log($contactEntry, 'debug');
			
			$req = new Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full?alt=json');
			$req->setRequestMethod('POST');
			$req->setRequestHeaders(['content-length' => strlen($contactEntry),
									 'GData-Version'=> '3.0',
									 'content-type'=>'application/atom+xml; charset=UTF-8; type=feed']);
			$req->setPostBody($contactEntry);
			$val = $client->getAuth()->authenticatedRequest($req);
			$res = json_decode($val->getResponseBody());
			if (isset($res->entry)) {
				//save googleId to db
				$contact->google_id = $this->google_getid($res->entry);
				if ($this->Contacts->save($contact)) {
					$result = ['saved' => true];
				} else {
					$result = ['saved' => false];
				}
				$this->set(compact('result'));
			} else {
				$this->log('Contact did not saved to google', 'debug');
				$this->log($res, 'debug');
			}
		} else {
			$this->google_connectpage($client);
		}
	}
	
	private function formatAddress($address){
		preg_match('/\d{4}/', $address, $zip);
		$zip = $this->Contacts->Zips->find()
				->select(['id', 'zip', 'name'])
				->where(['zip' => $zip[0]])
				->toArray();
		$zip = $zip[0];
		$address = str_replace("\n", ' ', $address);
		$address = str_replace($zip->zip, '', $address);
		$address = str_replace($zip->name, '', $address);
		$zip = [
				'zip_id' => $zip->id,
				'address' => $address
				];
		return $zip;
	}
	
	public function google_sync(){
		$client = $this->google_client();
		if ($client->getAccessToken()) {
			//this will run with cron every 6 hours
			//collect changed contacts at google
			$req = new Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full'.
										   '?alt=json'.
										   '&updated-min='.gmdate('Y-m-d\TH:i:s', strtotime('-6 hours')));
			$val = $client->getAuth()->authenticatedRequest($req);
			$gContacts = json_decode($val->getResponseBody());
			//we should loop throught the entry to check what data is changed
			//ignore name changes
			//gd$email, gd$phoneNumber, gd$postalAddress
			//collect changed contacts in our database
			//check if there is any conflict
			//save local changes to goole
			//save google changes to local
			
		} else {
			$this->log('Unsuccessful sync', $debug);
		}
	}
	
	public function merge(){
		//dont forget to rename the pic if neccessarry
	}
	
	public function transfer($id){
		//transfer contact to an other user
	}
	
	public function sendmail(){
		$referer = explode('/', $this->request->referer());
		$contactId = end($referer);
		$contact = $this->Contacts->get($contactId);

		$email = new Email('default');
		$email->from([$this->Auth->user('email') => $this->Auth->user('realname')])
			->to($contact->email)
			->subject($this->request->data['subject'])
			->send($this->request->data['message']);

		//add to history
		$history = $this->Contacts->Histories->newEntity();
		$history->contact_id = $contactId;
		$history->date = date('Y-m-d H:i:s');
		$history->user_id = $this->Auth->user('id');
		$history->event_id = 3;	//TODO HC
		$history->detail = $this->request->data['subject'] . ' : ' . $this->request->data['message'];		
		$saved = $this->Contacts->Histories->save($history);
		if ($saved) {
			$result = ['save' => true,
						'message' => __('The history has been saved.')];
		} else {
			$result = ['save' => false,
						'message' => __('The history could not be saved.')];
		}
		$this->set('result', $result);
	}
}
