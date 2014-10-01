<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {

	public function searchname(){
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"']);
		//debug($query);
		foreach($query as $row){
			$result[] = array('value' => $row->id,
							  'label' => $row->name . ' : ' . $row->contactname);
		}
		//debug($result);
		$this->set('result', $result);
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Countries', 'Zips', 'Contactsources']
		];
		$this->set('contacts', $this->paginate($this->Contacts));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contact = $this->Contacts->get($id, [
			'contain' => ['Countries', 'Zips', 'Contactsources', 'Groups', 'Linkups', 'Users', 'Histories']
		]);
		$this->set('contact', $contact);
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
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$countries = $this->Contacts->Countries->find('list');
		$zips = $this->Contacts->Zips->find('list', ['idField' => 'id', 'valueField' => 'full_zip']);
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$linkups = $this->Contacts->Linkups->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'countries', 'zips', 'contactsources', 'groups', 'linkups', 'users'));
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
			'contain' => ['Groups', 'Linkups', 'Users']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contact = $this->Contacts->patchEntity($contact, $this->request->data);
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$countries = $this->Contacts->Countries->find('list');
		$zips = $this->Contacts->Zips->find('list');
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$linkups = $this->Contacts->Linkups->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'countries', 'zips', 'contactsources', 'groups', 'linkups', 'users'));
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
		$this->request->allowMethod('post', 'delete');
		if ($this->Contacts->delete($contact)) {
			$this->Flash->success('The contact has been deleted.');
		} else {
			$this->Flash->error('The contact could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
