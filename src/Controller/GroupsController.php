<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Users']
		];
		$this->set('groups', $this->paginate($this->Groups));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$group = $this->Groups->get($id, [
			'contain' => ['Users', 'Contacts', 'Histories']
		]);
		$this->set('group', $group);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$group = $this->Groups->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Groups->save($group)) {
				$this->Flash->success('The group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The group could not be saved. Please, try again.');
			}
		}
		$users = $this->Groups->Users->find('list');
		$contacts = $this->Groups->Contacts->find('list');
		$this->set(compact('group', 'users', 'contacts'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$group = $this->Groups->get($id, [
			'contain' => ['Contacts']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$group = $this->Groups->patchEntity($group, $this->request->data);
			if ($this->Groups->save($group)) {
				$this->Flash->success('The group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The group could not be saved. Please, try again.');
			}
		}
		$users = $this->Groups->Users->find('list');
		$contacts = $this->Groups->Contacts->find('list');
		$this->set(compact('group', 'users', 'contacts'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$group = $this->Groups->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Groups->delete($group)) {
			$this->Flash->success('The group has been deleted.');
		} else {
			$this->Flash->error('The group could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
