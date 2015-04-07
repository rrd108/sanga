<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController {

	public function isAuthorized($user = null) {
        return true;
    }

	public function search(){
		$query = $this->Groups->find()
				->select(['id', 'name'])
				->where(['name LIKE "'.$this->request->query('term').'%"']);
		foreach($query as $row){
			$result[] = array('value' => $row->id,
							  'label' => $row->name
							  );
		}
		//debug($result);die();
		$this->set('result', $result);
		$this->set('_serialize', 'result');
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$groups = $this->Groups->find('accessible',
									  [
									   'User.id' => $this->Auth->user('id'),
									   'shared' => true
									   ])
								->contain(['AdminUsers']);
		$this->set('groups', $this->paginate($groups));
		
		//for adding new group
		$this->set('group', $this->Groups->newEntity($this->request->data));
		$users = $this->Groups->Users->find('list');
		$contacts = $this->Groups->Contacts->find('list');
		$this->set(compact('users', 'contacts'));
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
			'contain' => ['Users', 'Contacts', 'AdminUsers']
		]);
		//debug($group);
		$this->set('group', $group);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		if(!isset($this->request->data['admin_user_id'])){
			$this->request->data['admin_user_id'] = $this->Auth->User('id');
		}
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
			'contain' => ['Users', 'Contacts']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$group = $this->Groups->patchEntity($group, $this->request->data);
			if ($this->Groups->save($group)) {
				$this->Flash->success('The group has been saved.');
				//return $this->redirect(['action' => 'index']);
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
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Groups->delete($group)) {
			$this->Flash->success('The group has been deleted.');
		} else {
			$this->Flash->error('The group could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
