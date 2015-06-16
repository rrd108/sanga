<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersUsergroups Controller
 *
 * @property App\Model\Table\UsersUsergroupsTable $UsersUsergroups
 */
class UsersUsergroupsController extends AppController
{

    public function isAuthorized($user = null)
    {
        return true;
    }

    /**
 * Index method
 *
 * @return void
 */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Usergroups']
        ];
        $this->set('usersUsergroups', $this->paginate($this->UsersUsergroups));
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
        $usersUsergroup = $this->UsersUsergroups->get(
            $id,
            [
            'contain' => ['Users', 'Usergroups']
            ]
        );
        $this->set('usersUsergroup', $usersUsergroup);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $usersUsergroup = $this->UsersUsergroups->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->UsersUsergroups->save($usersUsergroup)) {
                $this->Flash->success('The users usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The users usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->UsersUsergroups->Users->find('list');
        $usergroups = $this->UsersUsergroups->Usergroups->find('list');
        $this->set(compact('usersUsergroup', 'users', 'usergroups'));
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
        $usersUsergroup = $this->UsersUsergroups->get(
            $id,
            [
            'contain' => []
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersUsergroup = $this->UsersUsergroups->patchEntity($usersUsergroup, $this->request->data);
            if ($this->UsersUsergroups->save($usersUsergroup)) {
                $this->Flash->success('The users usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The users usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->UsersUsergroups->Users->find('list');
        $usergroups = $this->UsersUsergroups->Usergroups->find('list');
        $this->set(compact('usersUsergroup', 'users', 'usergroups'));
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
        $usersUsergroup = $this->UsersUsergroups->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->UsersUsergroups->delete($usersUsergroup)) {
            $this->Flash->success('The users usergroup has been deleted.');
        } else {
            $this->Flash->error('The users usergroup could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
