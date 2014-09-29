<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactsUsers Controller
 *
 * @property App\Model\Table\ContactsUsersTable $ContactsUsers
 */
class ContactsUsersController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('contactsUsers', $this->paginate($this->ContactsUsers));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contactsUser = $this->ContactsUsers->get($id, [
			'contain' => []
		]);
		$this->set('contactsUser', $contactsUser);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contactsUser = $this->ContactsUsers->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->ContactsUsers->save($contactsUser)) {
				$this->Flash->success('The contacts user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('contactsUser'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contactsUser = $this->ContactsUsers->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contactsUser = $this->ContactsUsers->patchEntity($contactsUser, $this->request->data);
			if ($this->ContactsUsers->save($contactsUser)) {
				$this->Flash->success('The contacts user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('contactsUser'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contactsUser = $this->ContactsUsers->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->ContactsUsers->delete($contactsUser)) {
			$this->Flash->success('The contacts user has been deleted.');
		} else {
			$this->Flash->error('The contacts user could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
