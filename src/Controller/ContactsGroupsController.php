<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactsGroups Controller
 *
 * @property App\Model\Table\ContactsGroupsTable $ContactsGroups
 */
class ContactsGroupsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Groups', 'Contacts']
		];
		$this->set('contactsGroups', $this->paginate($this->ContactsGroups));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contactsGroup = $this->ContactsGroups->get($id, [
			'contain' => ['Groups', 'Contacts']
		]);
		$this->set('contactsGroup', $contactsGroup);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contactsGroup = $this->ContactsGroups->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->ContactsGroups->save($contactsGroup)) {
				$this->Flash->success('The contacts group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts group could not be saved. Please, try again.');
			}
		}
		$groups = $this->ContactsGroups->Groups->find('list');
		$contacts = $this->ContactsGroups->Contacts->find('list');
		$this->set(compact('contactsGroup', 'groups', 'contacts'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contactsGroup = $this->ContactsGroups->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contactsGroup = $this->ContactsGroups->patchEntity($contactsGroup, $this->request->data);
			if ($this->ContactsGroups->save($contactsGroup)) {
				$this->Flash->success('The contacts group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts group could not be saved. Please, try again.');
			}
		}
		$groups = $this->ContactsGroups->Groups->find('list');
		$contacts = $this->ContactsGroups->Contacts->find('list');
		$this->set(compact('contactsGroup', 'groups', 'contacts'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contactsGroup = $this->ContactsGroups->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->ContactsGroups->delete($contactsGroup)) {
			$this->Flash->success('The contacts group has been deleted.');
		} else {
			$this->Flash->error('The contacts group could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
