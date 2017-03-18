<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    public $components = [
        'RequestHandler' =>
            [
                'viewClassMap' =>
                    [
                        'csv' => 'CsvView.Csv'
                    ]
            ]
    ];

    public function isAuthorized($user = null)
    {
        return true;
    }

    public function search()
    {
        $query = $this->Groups->find()
            ->select(['id', 'name'])
            ->where(['name LIKE "'.$this->request->getQuery('term').'%"']);
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
        $groups = $this->Groups->find(
            'accessible',
            [
            'User.id' => $this->Auth->user('id'),
            'shared' => true
            ]
        )
        ->contain(['Contacts', 'AdminUsers']);
        $this->set('groups', $this->paginate($groups));

        //for adding new group
        $this->set('group', $this->Groups->newEntity($this->request->getData()));
        $users = $this->Groups->Users->find('list');
        $contacts = $this->Groups->Contacts->find('list');
        $this->set(compact('users', 'contacts'));
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
        if ($id) {

            if(! $this->Groups->isReadable($this->Auth->User('id'), $id)) {
                $this->Flash->error(__('Permission deined'));
                $this->render();
            }

            $this->set('isWritable', $this->Groups->isWritable($this->Auth->User('id'), $id));

            $group = $this->Groups->get(
                $id,
                [
                    'contain' => ['Users', 'Contacts', 'Contacts.Zips', 'Contacts.WorkplaceZips',
                        'AdminUsers',
                        'Histories' => function ($q) {
                            return $q->group(['date', 'event_id', 'detail', 'Histories.id']);
                        },
                        'Histories.Users', 'Histories.Events', 'Histories.Units'
                    ]
                ]
            );
            //debug($group);

            if ($this->request->getParams('_ext') == 'csv') {
                $i = 0;
                $_header = ['id', 'legalname', 'contactname', 'phone', 'email', 'birth', 'sex'];
                foreach ($group->contacts as $contact) {
                    foreach ($_header as $field) {
                        $csvData[$i][] = $contact[$field];
                    }
                    $csvData[$i][] = $contact['zip']['zip'];
                    $csvData[$i][] = $contact['zip']['name'];
                    $csvData[$i][] = $contact['address'];
                    $csvData[$i][] = $contact['workplace'];
                    $csvData[$i][] = $contact['workplace_zip']['zip'];
                    $csvData[$i][] = $contact['workplace_zip']['name'];
                    $csvData[$i][] = $contact['workplace_address'];
                    $csvData[$i][] = $contact['workplace_phone'];
                    $csvData[$i][] = $contact['workplace_email'];
                    $i++;
                }
                $_header = array_merge($_header, ['zip', 'city', 'address', 'workplace', 'workplace zip',
                    'workplace address', 'workplace city', 'workplace phone', 'workplace email']);
                $_delimiter = ';';
                $_serialize = 'csvData';
                $this->response->setDownload($group->name . '.csv');
                $this->set(compact('csvData', '_serialize', '_header', '_delimiter'));
            } else {
                $this->set('group', $group);
            }
        }
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        if (!$this->request->getData('admin_user_id')) {
            $this->request->setData('admin_user_id', $this->Auth->User('id'));
        }
        $group = $this->Groups->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->Groups->save($group)) {
                $this->Flash->success('The group has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The group could not be saved. Please, try again.');
            }
        }
        $users = $this->Groups->Users->find('list');
        $contacts = $this->Groups->Contacts->find('list');
        $this->set(compact('group', 'users', 'contacts'));
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
        $group = $this->Groups->get(
            $id,
            [
            'contain' => ['Users', 'Contacts']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success('The group has been saved.');
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The group could not be saved. Please, try again.');
            }
        }
        $users = $this->Groups->Users->find('list');
        $contacts = $this->Groups->Contacts->find('list');
        $this->set(compact('group', 'users', 'contacts'));
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
        $group = $this->Groups->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Groups->delete($group)) {
            $this->Flash->success('The group has been deleted.');
        } else {
            $this->Flash->error('The group could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
