<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{

	public function isAuthorized($user = null) {
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
            'contain' => ['Users']
        ];
        $this->set('settings', $this->paginate($this->Settings));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('setting', $setting);
        $this->set('_serialize', ['setting']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        $users = $this->Settings->Users->find('list', ['limit' => 200]);
        $this->set(compact('setting', 'users'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Edit method
     *
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $setting = $this->Settings
            ->find()
            ->where(['user_id' => $this->Auth->user('id'),
					'name' => $this->request->data['sName']])
            ->first();
        //debug($setting);die();
        //debug($this->request->data);die();
        /*
        [
            'contactname' => '1',
            'name' => '0',
            'zip_id' => '1',
            'address' => '0',
            'phone' => '0',
            'email' => '0',
            'birth' => '0',
            'workplace' => '0',
            'workplace_zip_id' => '0',
            'workplace_address' => '0',
            'workplace_phone' => '0',
            'workplace_email' => '0',
            'contactsource_id' => '0',
            'users' => '0',
            'skills' => '1',
            'groups' => '0',
            'sName' => 'Contacts/index'
        ]
        */
        $select = [];
        foreach($this->request->data as $name => $value) {
            if ($name != 'sName' && $value) {
                $select[] = 'Contacts.' . $name;
            }
        }
        $this->request->data = ['user_id' => $this->Auth->user('id'),
                                'name' => $this->request->data['sName'],
                                'value' => serialize($select)
                                ];
        
        if (empty($setting)){
            $this->add();
            //return will be done by add
        }
        $setting = $this->Settings->get($setting->id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $result = ['message' => __('The setting has been saved')];
            } else {
                $result = ['message' => __('The setting could not be saved. Please, try again.')];
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success('The setting has been deleted.');
        } else {
            $this->Flash->error('The setting could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
