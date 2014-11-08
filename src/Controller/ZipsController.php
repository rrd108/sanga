<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Zips Controller
 *
 * @property App\Model\Table\ZipsTable $Zips
 */
class ZipsController extends AppController {

	public function searchzip(){
		$query = $this->Zips->find()
				->select(['id', 'zip', 'name'])
				->where(['zip LIKE "'.$this->request->query('term').'%"'])
				->orWhere(['name LIKE "'.$this->request->query('term').'%"']);
		//debug($query);
		foreach($query as $row){
			$result[] = array('value' => $row->id,
							  'label' => $row->zip . ' ' . $row['name']
							  );
		}
		//debug($result);die();
		$this->set('result', $result);
	}
/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Countries']
		];
		$this->set('zips', $this->paginate($this->Zips));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$zip = $this->Zips->get($id, [
			'contain' => ['Countries', 'Contacts']
		]);
		$this->set('zip', $zip);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$zip = $this->Zips->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Zips->save($zip)) {
				$this->Flash->success('The zip has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The zip could not be saved. Please, try again.');
			}
		}
		$countries = $this->Zips->Countries->find('list');
		$this->set(compact('zip', 'countries'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$zip = $this->Zips->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$zip = $this->Zips->patchEntity($zip, $this->request->data);
			if ($this->Zips->save($zip)) {
				$this->Flash->success('The zip has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The zip could not be saved. Please, try again.');
			}
		}
		$countries = $this->Zips->Countries->find('list');
		$this->set(compact('zip', 'countries'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$zip = $this->Zips->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Zips->delete($zip)) {
			$this->Flash->success('The zip has been deleted.');
		} else {
			$this->Flash->error('The zip could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
