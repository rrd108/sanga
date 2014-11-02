<?php
namespace RBruteForce\Controller;

use RBruteForce\Controller\AppController;
use Cake\Event\Event;

/**
 * Rbruteforces Controller
 *
 * @property RBruteForce\Model\Table\RbruteforcesTable $Rbruteforces
 */
class RbruteforcesController extends AppController {

	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
	    $this->Auth->allow(['failed']);
	}

	public function failed(){
	}
	
/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('rbruteforces', $this->paginate($this->Rbruteforces));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$rbruteforce = $this->Rbruteforces->get($id, [
			'contain' => []
		]);
		$this->set('rbruteforce', $rbruteforce);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$rbruteforce = $this->Rbruteforces->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Rbruteforces->save($rbruteforce)) {
				$this->Flash->success('The rbruteforce has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The rbruteforce could not be saved. Please, try again.');
			}
		}
		$this->set(compact('rbruteforce'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$rbruteforce = $this->Rbruteforces->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$rbruteforce = $this->Rbruteforces->patchEntity($rbruteforce, $this->request->data);
			if ($this->Rbruteforces->save($rbruteforce)) {
				$this->Flash->success('The rbruteforce has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The rbruteforce could not be saved. Please, try again.');
			}
		}
		$this->set(compact('rbruteforce'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$rbruteforce = $this->Rbruteforces->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Rbruteforces->delete($rbruteforce)) {
			$this->Flash->success('The rbruteforce has been deleted.');
		} else {
			$this->Flash->error('The rbruteforce could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteall() {
		if ($this->Rbruteforces->deleteAll([])) {
			$this->Flash->success('All rbruteforce has been deleted.');
		} else {
			$this->Flash->error('All rbruteforce could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
