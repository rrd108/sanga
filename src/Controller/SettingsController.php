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
            'contain' => ['Users']
        ];
        $this->set('settings', $this->paginate($this->Settings));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param  string|null $id Setting id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setting = $this->Settings->get(
            $id,
            [
            'contain' => ['Users']
            ]
        );
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
        if ($this->request->is('post') || $this->request->is('ajax')) {
            if (! $this->request->getData('user_id')) {
                $this->request = $this->request->withData('user_id', $this->Auth->user('id'));
            }
            
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));
                $setting = ['message' => __('The setting has been saved.'),
                            'id' => $setting->id];
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
                $setting = ['message' => __('The setting could not be saved. Please, try again.')];
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', 'setting');
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
            ->where(
                [
                    'user_id' => $this->Auth->user('id'),
                    'name' => $this->request->getData('sName')
                ]
            )
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
        foreach ($this->request->getData() as $name => $value) {
            if ($name != 'sName' && $value) {
                $select[] = 'Contacts.' . $name;
            }
        }
        $this->request = $this->request->withData(
            [
                'user_id' => $this->Auth->user('id'),
                'name' => $this->request->getData('sName'),
                'value' => json_encode($select)
            ]
        );
        
        if (empty($setting)) {
            $this->add();
            return;
        }
        $setting = $this->Settings->get($setting->id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
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
     * @param  string|null $id Setting id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $result = ['message' => __('The setting has been deleted.')];
        } else {
            $result = ['message' => __('The setting could not be deleted. Please, try again.')];
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    public function update()
    {
        $settings = $this->Settings->find();
        foreach ($settings as $setting) {
            //fixing offset error
            $setting->value = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $setting->value);
            $setting->value = json_encode(unserialize($setting->value));
            $this->Settings->save($setting);
        }
    }
}
