<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    public function isAuthorized($user = null)
    {
        return true;
    }

    public function search()
    {
        $query = $this->Events->find()
            ->select(['id', 'name'])
            ->where(['name LIKE "%'.$this->request->getQuery('term').'%"']);
        foreach ($query as $row) {
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('events', $this->paginate($this->Events));

        //for adding new event
        $this->set('event', $this->Events->newEntity($this->request->getData()));
    }


    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        if (!$this->request->getData('user_id') && $this->Auth->User('role') < 9) {
            $this->request = $this->request->withData('user_id', $this->Auth->User('id'));
        }

        $event = $this->Events->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->Events->save($event)) {
                $this->Flash->success('The event has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The event could not be saved. Please, try again.');
            }
        }
        $users = $this->Events->Users->find('list');
        $this->set(compact('event', 'users'));
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
        $event = $this->Events->get(
            $id,
            [
            'contain' => []
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success('The event has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The event could not be saved. Please, try again.');
            }
        }
        $users = $this->Events->Users->find('list');
        $this->set(compact('event', 'users'));
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
        $event = $this->Events->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Events->delete($event)) {
            $this->Flash->success('The event has been deleted.');
        } else {
            $this->Flash->error('The event could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
