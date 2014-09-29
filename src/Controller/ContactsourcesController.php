<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contactsources Controller
 *
 * @property App\Model\Table\ContactsourcesTable $Contactsources
 */
class ContactsourcesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('contactsources', $this->paginate($this->Contactsources));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contactsource = $this->Contactsources->get($id, [
			'contain' => ['Contacts']
		]);
		$this->set('contactsource', $contactsource);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contactsource = $this->Contactsources->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Contactsources->save($contactsource)) {
				$this->Flash->success('The contactsource has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contactsource could not be saved. Please, try again.');
			}
		}
		$this->set(compact('contactsource'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contactsource = $this->Contactsources->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contactsource = $this->Contactsources->patchEntity($contactsource, $this->request->data);
			if ($this->Contactsources->save($contactsource)) {
				$this->Flash->success('The contactsource has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contactsource could not be saved. Please, try again.');
			}
		}
		$this->set(compact('contactsource'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contactsource = $this->Contactsources->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Contactsources->delete($contactsource)) {
			$this->Flash->success('The contactsource has been deleted.');
		} else {
			$this->Flash->error('The contactsource could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
