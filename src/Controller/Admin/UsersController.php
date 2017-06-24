<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

use Cake\Routing\Router;
use Cake\Network\Email\Email;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 *
 * user roles: 1 - normal
 *                 9 - CRM admin
 *                 10 - admin
 */
class UsersController extends AppController
{
    
    public $components = ['RBruteForce.RBruteForce'];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

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
            'users',
            $this->paginate(
                $this->Users->find()
                    ->contain('Contacts')
                    ->order(['Users.name'])
            )
        );
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
        $id = $id ? $id : $this->Auth->user('id');
        $user = $this->Users->get(
            $id,
            [
            'contain' => ['Contacts', 'Events', 'Groups', 'Histories', 'Notifications']
            ]
        );
        $this->set('user', $user);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $contacts = $this->Users->Contacts->find('list');
        $groups = $this->Users->Groups->find('list');
        $usergroups = $this->Users->Usergroups->find('list');
        $this->set(compact('user', 'contacts', 'groups', 'usergroups'));
    }

    /**
 * Edit method
 *
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function edit($id)
    {
        $id = $id ? $id : $this->Auth->user('id');
        $user = $this->Users->get(
            $id,
            [
            'contain' => ['Contacts', 'Groups', 'Usergroups']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $saved = $this->Users->save($user);
            if ($saved) {
                $json = ['save' => __('The user has been saved.')];
            } else {
                $error = '';
                foreach ($user->errors() as $field => $err) {
                    $error .= $field . ': ';
                    foreach ($err as $e) {
                        $error .= $e;
                    }
                }
                $json = [
                         'save' => __('The user could not be saved. Please, try again.'),
                         'error' => $error
                         ];
            }
        }
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
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
        $user = $this->Users->get($id);
        $this->request->allowMethod(['post', 'delete']);
        $user->active = false;
        if ($this->Users->save($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function personalize($id) {
        if (!$this->request->session()->read('switchUser')) {
            $this->request->session()->write('switchUser', $this->Auth->user('id'));
            $this->Auth->setUser($this->Users->get($id));
        } else {
            $this->Auth->setUser($this->Users->get($this->request->session()->read('switchUser')));
            $this->request->session()->delete('switchUser');
        }
        return $this->redirect('/');
    }
}
