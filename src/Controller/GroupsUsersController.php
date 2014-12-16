<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GroupsUsers Controller
 *
 * @property App\Model\Table\GroupsUsersTable $GroupsUsers
 */
class GroupsUsersController extends AppController {

	public function isAuthorized($user = null) {
        return true;
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Groups', 'Users']
		];
		$this->set('groupsUsers', $this->paginate($this->GroupsUsers));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$groupsUser = $this->GroupsUsers->get($id, [
			'contain' => ['Groups', 'Users']
		]);
		$this->set('groupsUser', $groupsUser);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$groupsUser = $this->GroupsUsers->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->GroupsUsers->save($groupsUser)) {
				$this->Flash->success('The groups user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The groups user could not be saved. Please, try again.');
			}
		}
		$groups = $this->GroupsUsers->Groups->find('list');
		$users = $this->GroupsUsers->Users->find('list');
		$this->set(compact('groupsUser', 'groups', 'users'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$groupsUser = $this->GroupsUsers->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$groupsUser = $this->GroupsUsers->patchEntity($groupsUser, $this->request->data);
			if ($this->GroupsUsers->save($groupsUser)) {
				$this->Flash->success('The groups user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The groups user could not be saved. Please, try again.');
			}
		}
		$groups = $this->GroupsUsers->Groups->find('list');
		$users = $this->GroupsUsers->Users->find('list');
		$this->set(compact('groupsUser', 'groups', 'users'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$groupsUser = $this->GroupsUsers->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->GroupsUsers->delete($groupsUser)) {
			$this->Flash->success('The groups user has been deleted.');
		} else {
			$this->Flash->error('The groups user could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
