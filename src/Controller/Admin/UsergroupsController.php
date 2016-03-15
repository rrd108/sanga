<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Usergroups Controller
 *
 * @property App\Model\Table\UsergroupsTable $Usergroups
 */
class UsergroupsController extends AppController
{

    public function isAuthorized($user = null)
    {
        if ($user['role'] >= 9) {
            return true;
        }
        return false;
    }

    /**
 * Index method
 *
 * @return void
 */
    public function index()
    {
        $this->set(
            'usergroups',
            $this->paginate(
                $this->Usergroups->find()->contain(['Users', 'AdminUsers'])
            )
        );
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $usergroup = $this->Usergroups->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Usergroups->save($usergroup)) {
                $this->Flash->success('The usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->Usergroups->Users->find('list');
        $this->set(compact('usergroup', 'users'));
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
        $usergroup = $this->Usergroups->get(
            $id,
            [
            'contain' => ['Users']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usergroup = $this->Usergroups->patchEntity($usergroup, $this->request->data);
            if ($this->Usergroups->save($usergroup)) {
                $this->Flash->success('The usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->Usergroups->Users->find('list');
        $this->set(compact('usergroup', 'users'));
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
        $usergroup = $this->Usergroups->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Usergroups->delete($usergroup)) {
            $this->Flash->success('The usergroup has been deleted.');
        } else {
            $this->Flash->error('The usergroup could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
