<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\String;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {
	
	public $helpers = ['Number'];

	//ajax keresések a név mezőkben
	public function searchname(){
		$contact = $this->Contacts->newEntity($this->request->data);
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"']);
		//debug($query);
		$highlight = array('format' => '<span class="b i">\1</span>');
		foreach($query as $row){
			if($row->name && $row->contactname){
				$label = String::highlight($row->name, $this->request->query('term'), $highlight)  . ' : ' .
										String::highlight($row->contactname, $this->request->query('term'), $highlight);
			}
			elseif($row->name){
				$label = String::highlight($row->name, $this->request->query('term'), $highlight);
			}
			elseif($row->contactname){
				$label = String::highlight($row->contactname, $this->request->query('term'), $highlight);
			}
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		//debug($result);die();
		$this->set('result', $result);
		$this->set('contact', $contact);
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
	public function search(){
		
		if($this->request->data){
			/*
			 debug($this->request->data);
			 [
				'zip_id' => '162',
				'area' => '50',
				'active' => '1',
				'linkup_id' => '5'
			]
			*/
			
			$center = $this->Contacts->Zips->find()
					->select(['lat', 'lng'])
					->where(['id' => $this->request->data['zip_id']])
					;//->toArray();
			$cent = $center->toArray();
			//debug($cent[0]->lat);
			
			$expr = $center->newExpr()->add('(3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$cent[0]->lat.
											' - abs( Contacts.lat ) ) * pi( ) /180 /2 ) , 2 ) + COS( '.$cent[0]->lat.
											' * pi( ) /180 ) * COS( abs( Contacts.lat ) * pi( ) /180 ) * POWER( SIN( ( '.
											$cent[0]->lng.' - Contacts.lng ) * pi( ) /180 /2 ) , 2 ) ) ))');
			//debug($expr);
			
			$result = $this->Contacts->find()
					->contain(['Zips', 'Linkups'])
					->select(['name', 'Zips.zip', 'Zips.name', 'distance' => $expr])
					->where(['active' => true,
							 'distance' => $expr])
					->matching('Linkups', function($q){
						return $q->where(['Linkups.id' => $this->request->data['linkup_id']]);
						})
					->having(['distance <=' => $this->request->data['area']])
					->order(['distance' => 'ASC']);
					//->toArray();
			//debug($result);
			$this->set('result', $result);
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$myContacts = $this->Contacts->find()
				->select(['Contacts.id', 'Contacts.name', 'Contacts.contactname', 'Contacts.address',
						  'Zips.id', 'Zips.zip', 'Zips.name'])
				->contain(['Zips', 'users', 'Groups'])		//ha itten "Users" van akkor nem jó query generálódik, ez egy bug de jól jön. https://github.com/cakephp/cakephp/issues/5109
				->matching('Users', function($q) {
					    return $q->where(['Users.id' => $this->Auth->user('id')]);
					});

		$inmygroupsContacts = $this->Contacts->find()
				->select(['Contacts.id', 'Contacts.name', 'Contacts.contactname', 'Contacts.address',
						  'Zips.id', 'Zips.zip', 'Zips.name'])
				->contain(['Zips', 'Users', 'groups'])
				->matching('Groups', function($q){
						return $q->where(['Groups.id' => 5]);
					});
		$contacts = $myContacts->union($inmygroupsContacts);
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
			'contain' => ['Zips', 'Contactsources', 'Groups' => ['Users'], 'Skills', 'Users', 'Histories']
		]);
		$this->set('contact', $contact);
		
		$family = $this->Contacts->find()
				->where(['family_id' => $contact->family_id]);
		$this->set('family', $family);
		
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Events', 'Units', 'Groups']
		];
		$histories = $this->Contacts->Histories->find()
				->where(['contact_id' => $id]);
		$this->set('histories', $this->paginate($histories));
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contact = $this->Contacts->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				debug($contact->errors());
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list', ['idField' => 'id', 'valueField' => 'full_zip']);
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$skills = $this->Contacts->Skills->find('list');
		$users = $this->Contacts->Users->find('list');
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
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'view', $id]);
			} else {
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
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
	}
}