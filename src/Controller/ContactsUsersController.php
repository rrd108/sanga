<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactsUsers Controller
 *
 * @property App\Model\Table\ContactsUsersTable $ContactsUsers
 */
class ContactsUsersController extends AppController
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
            'contain' => ['Contacts', 'Users']
        ];
        $this->set('contactsUsers', $this->paginate($this->ContactsUsers));
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
        $contactsUser = $this->ContactsUsers->get(
            $id,
            [
            'contain' => ['Contacts', 'Users']
            ]
        );
        $this->set('contactsUser', $contactsUser);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $contactsUser = $this->ContactsUsers->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->ContactsUsers->save($contactsUser)) {
                $this->Flash->success('The contacts user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The contacts user could not be saved. Please, try again.');
            }
        }
        $contacts = $this->ContactsUsers->Contacts->find('list');
        $users = $this->ContactsUsers->Users->find('list');
        $this->set(compact('contactsUser', 'contacts', 'users'));
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
        $contactsUser = $this->ContactsUsers->get(
            $id,
            [
            'contain' => []
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactsUser = $this->ContactsUsers->patchEntity($contactsUser, $this->request->getData());
            if ($this->ContactsUsers->save($contactsUser)) {
                $this->Flash->success('The contacts user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The contacts user could not be saved. Please, try again.');
            }
        }
        $contacts = $this->ContactsUsers->Contacts->find('list');
        $users = $this->ContactsUsers->Users->find('list');
        $this->set(compact('contactsUser', 'contacts', 'users'));
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
        $contactsUser = $this->ContactsUsers->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->ContactsUsers->delete($contactsUser)) {
            $this->Flash->success('The contacts user has been deleted.');
        } else {
            $this->Flash->error('The contacts user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
