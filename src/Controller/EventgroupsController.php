<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventgroups Controller
 *
 * @property App\Model\Table\EventgroupsTable $Eventgroups
 */
class EventgroupsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('eventgroups', $this->paginate($this->Eventgroups));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$eventgroup = $this->Eventgroups->get($id, [
			'contain' => ['Events']
		]);
		$this->set('eventgroup', $eventgroup);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$eventgroup = $this->Eventgroups->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Eventgroups->save($eventgroup)) {
				$this->Flash->success('The eventgroup has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The eventgroup could not be saved. Please, try again.');
			}
		}
		$this->set(compact('eventgroup'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$eventgroup = $this->Eventgroups->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$eventgroup = $this->Eventgroups->patchEntity($eventgroup, $this->request->data);
			if ($this->Eventgroups->save($eventgroup)) {
				$this->Flash->success('The eventgroup has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The eventgroup could not be saved. Please, try again.');
			}
		}
		$this->set(compact('eventgroup'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$eventgroup = $this->Eventgroups->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Eventgroups->delete($eventgroup)) {
			$this->Flash->success('The eventgroup has been deleted.');
		} else {
			$this->Flash->error('The eventgroup could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
