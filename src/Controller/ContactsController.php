<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
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
			'contain' => []
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
		$this->set(compact('contact'));
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
			'contain' => []
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
		$this->set(compact('contact'));
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
