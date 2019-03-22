<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Skills Controller
 *
 * @property App\Model\Table\SkillsTable $Skills
 */
class SkillsController extends AppController
{
    public function isAuthorized($user = null)
    {
        return true;
    }

    public function search()
    {
        $result = [];
        $query = $this->Skills->find()
            ->select(['id', 'name'])
            ->where(['name LIKE "'.$this->request->getQuery('term').'%"']);
        //debug($query);
        foreach ($query as $row) {
            $result[] = [
                'value' => $row->id,
                'label' => $row->name
            ];
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
    public function index()
    {
        $this->set('skills', $this->paginate($this->Skills));
    }

    /**
 * View method
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function view($id = null)
    {
        $skill = $this->Skills->get(
            $id,
            [
            'contain' => ['Contacts']
            ]
        );
        $this->set('skill', $skill);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $skill = $this->Skills->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->Skills->save($skill)) {
                $this->Flash->success('The skill has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The skill could not be saved. Please, try again.');
            }
        }
        $contacts = $this->Skills->Contacts->find('list');
        $this->set(compact('skill', 'contacts'));
    }

    /**
 * Edit method
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function edit($id = null)
    {
        $skill = $this->Skills->get(
            $id,
            [
            'contain' => ['Contacts']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skill = $this->Skills->patchEntity($skill, $this->request->getData());
            if ($this->Skills->save($skill)) {
                $this->Flash->success('The skill has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The skill could not be saved. Please, try again.');
            }
        }
        $contacts = $this->Skills->Contacts->find('list');
        $this->set(compact('skill', 'contacts'));
    }

    /**
 * Delete method
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function delete($id = null)
    {
        $skill = $this->Skills->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Skills->delete($skill)) {
            $this->Flash->success('The skill has been deleted.');
        } else {
            $this->Flash->error('The skill could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
