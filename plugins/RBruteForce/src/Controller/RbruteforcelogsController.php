<?php
namespace RBruteForce\Controller;

use RBruteForce\Controller\AppController;

/**
 * Rbruteforcelogs Controller
 *
 * @property RBruteForce\Model\Table\RbruteforcelogsTable $Rbruteforcelogs
 */
class RbruteforcelogsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('rbruteforcelogs', $this->paginate($this->Rbruteforcelogs));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$rbruteforcelog = $this->Rbruteforcelogs->get($id, [
			'contain' => []
		]);
		$this->set('rbruteforcelog', $rbruteforcelog);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$rbruteforcelog = $this->Rbruteforcelogs->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Rbruteforcelogs->save($rbruteforcelog)) {
				$this->Flash->success('The rbruteforcelog has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The rbruteforcelog could not be saved. Please, try again.');
			}
		}
		$this->set(compact('rbruteforcelog'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$rbruteforcelog = $this->Rbruteforcelogs->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$rbruteforcelog = $this->Rbruteforcelogs->patchEntity($rbruteforcelog, $this->request->data);
			if ($this->Rbruteforcelogs->save($rbruteforcelog)) {
				$this->Flash->success('The rbruteforcelog has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The rbruteforcelog could not be saved. Please, try again.');
			}
		}
		$this->set(compact('rbruteforcelog'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$rbruteforcelog = $this->Rbruteforcelogs->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Rbruteforcelogs->delete($rbruteforcelog)) {
			$this->Flash->success('The rbruteforcelog has been deleted.');
		} else {
			$this->Flash->error('The rbruteforcelog could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteall() {
		if ($this->Rbruteforcelogs->deleteAll([])) {
			$this->Flash->success('All rbruteforcelog has been deleted.');
		} else {
			$this->Flash->error('All rbruteforcelog could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
