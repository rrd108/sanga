<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactsSkills Controller
 *
 * @property App\Model\Table\ContactsSkillsTable $ContactsSkills
 */
class ContactsSkillsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Contacts', 'Skills']
		];
		$this->set('contactsSkills', $this->paginate($this->ContactsSkills));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contactsSkill = $this->ContactsSkills->get($id, [
			'contain' => ['Contacts', 'Skills']
		]);
		$this->set('contactsSkill', $contactsSkill);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contactsSkill = $this->ContactsSkills->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->ContactsSkills->save($contactsSkill)) {
				$this->Flash->success('The contacts skill has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts skill could not be saved. Please, try again.');
			}
		}
		$contacts = $this->ContactsSkills->Contacts->find('list');
		$skills = $this->ContactsSkills->Skills->find('list');
		$this->set(compact('contactsSkill', 'contacts', 'skills'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contactsSkill = $this->ContactsSkills->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contactsSkill = $this->ContactsSkills->patchEntity($contactsSkill, $this->request->data);
			if ($this->ContactsSkills->save($contactsSkill)) {
				$this->Flash->success('The contacts skill has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The contacts skill could not be saved. Please, try again.');
			}
		}
		$contacts = $this->ContactsSkills->Contacts->find('list');
		$skills = $this->ContactsSkills->Skills->find('list');
		$this->set(compact('contactsSkill', 'contacts', 'skills'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contactsSkill = $this->ContactsSkills->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->ContactsSkills->delete($contactsSkill)) {
			$this->Flash->success('The contacts skill has been deleted.');
		} else {
			$this->Flash->error('The contacts skill could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
