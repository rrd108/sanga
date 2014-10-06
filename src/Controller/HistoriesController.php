<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Histories Controller
 *
 * @property App\Model\Table\HistoriesTable $Histories
 */
class HistoriesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Linkups', 'Events', 'Units', 'Groups']
		];
		$this->set('histories', $this->paginate($this->Histories));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$history = $this->Histories->get($id, [
			'contain' => ['Contacts', 'Users', 'Linkups', 'Events', 'Units', 'Groups']
		]);
		$this->set('history', $history);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$history = $this->Histories->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Histories->save($history)) {
				$this->Flash->success('The history has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The history could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Histories->Contacts->find('list');
		$users = $this->Histories->Users->find('list');
		$linkups = $this->Histories->Linkups->find('list');
		$events = $this->Histories->Events->find('list');
		$units = $this->Histories->Units->find('list');
		$groups = $this->Histories->Groups->find('list');
		$this->set(compact('history', 'contacts', 'users', 'linkups', 'events', 'units', 'groups'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$history = $this->Histories->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$history = $this->Histories->patchEntity($history, $this->request->data);
			if ($this->Histories->save($history)) {
				$this->Flash->success('The history has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The history could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Histories->Contacts->find('list');
		$users = $this->Histories->Users->find('list');
		$linkups = $this->Histories->Linkups->find('list');
		$events = $this->Histories->Events->find('list');
		$units = $this->Histories->Units->find('list');
		$groups = $this->Histories->Groups->find('list');
		$this->set(compact('history', 'contacts', 'users', 'linkups', 'events', 'units', 'groups'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$history = $this->Histories->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Histories->delete($history)) {
			$this->Flash->success('The history has been deleted.');
		} else {
			$this->Flash->error('The history could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
