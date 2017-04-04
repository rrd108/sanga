<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Histories Controller
 *
 * @property App\Model\Table\HistoriesTable $Histories
 */
class HistoriesController extends AppController
{

    public $helper = ['Time'];

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
        $contain = ['Contacts', 'Users', 'Groups', 'Events', 'Units'];
        $order = ['Histories.date' => 'DESC', 'Histories.id' => 'DESC'];

        if (! empty($this->request->getData())) {
            //TODO see accessible only
            $where = [];

            if (! empty($this->request->getData('fcontact_id'))) {
                $where['Histories.contact_id'] = $this->request->getData('fcontact_id');
            }
            if (! empty($this->request->getData('daterange'))) {
                $dates = str_split(' - ', $this->request->getData('daterange'));
                $between = function ($exp) use ($dates) {
                    return $exp->between('date', $dates[0], $dates[1], 'date');
                };
            }
            if (! empty($this->request->getData('fuser_id'))) {
                $where['Histories.user_id'] = $this->request->getData('fuser_id');
            }
            if (! empty($this->request->getData('fgroup_id'))) {
                $where['Histories.group_id'] = $this->request->getData('fgroup_id');
            }
            if (! empty($this->request->getData('fevent_id'))) {
                $where['Histories.event_id'] = $this->request->getData('fevent_id');
            }
            if (! empty($this->request->getData('fdetail'))) {
                $where['Histories.detail LIKE'] = '%' . $this->request->getData('fdetail') . '%';
            }

            $histories = $this->Histories->find()->where($where);

            if (isset($dates)) {
                $histories->andWhere($between);
            }
            $histories->contain($contain)
                ->order($order);
            $this->set('histories', $this->paginate($histories));
        } else {
            //we should call paginate like this to do not mess up union
            $histories = $this->Histories->find();
            $this->paginate = [
                'finder' => [
                    'accessibleBy' => [
                        'User.id' => $this->Auth->user('id'),
                        '_contain' => $contain,
                        '_order' => $order,
                        '_page' => $this->request->getQuery('page') ? $this->request->getQuery('page') : 1,
                        '_limit' => 20
                    ]
                ]
            ];
            $this->set('histories', $this->paginate());
        }
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
        $history = $this->Histories->get(
            $id,
            [
            'contain' => ['Contacts', 'Users', 'Groups', 'Events', 'Units']
            ]
        );
        $this->set('history', $history);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $history = $this->Histories->newEntity($this->request->getData());
        $history->user_id = $this->Auth->user('id');
        if ($this->request->is('post')) {
            //debug($this->request->data);die();

            if ($this->request->getData('target_group_id') && ! $this->request->getData('contact_id')) {    //add an event to multiple group members
                $group = $this->Histories->groups->get($this->request->getData('group_id'), ['contain' => 'Contacts']);
                exec(WWW_ROOT . '../bin/cake history ' . json_encode(json_encode($history)) . ' ' . json_encode(json_encode($group)) . ' ' . $this->Auth->user('id') . ' > /dev/null &');
                $result = ['save' => true,
                            'message' => __('Adding history event to all group members started in the background')];
            } else {
                $saved = $this->Histories->save($history);
                if ($saved) {
                    $message = __('The history has been saved.');
                    if ($this->request->is('ajax')) {
                        $this->Flash->success($message);
                        $result = [
                            'success' => true,
                            'message' => $message
                        ];
                    } else {
                        $this->Flash->success($message);
                        return $this->redirect(['action' => 'index']);
                    }
                } else {
                    $message = __('The history could not be saved. Please, try again.');
                    if ($this->request->is('ajax')) {
                        $result = [
                            'success' => false,
                            'message' => $message,
                            'errors' => $this->getErrors($history->errors())
                        ];
                    } else {
                        $this->Flash->error($message);
                        $this->log($this->getErrors($history->errors()), 'debug');
                    }
                }
            }
        }

        if ($this->request->is('ajax')) {
            $this->set(compact('result'));
            $this->set('_serialize', 'result');
            return;
        }

        $contacts = $this->Histories->Contacts->find('list');
        $groups = $this->Histories->Groups->find('list');
        $events = $this->Histories->Events->find('list');
        $units = $this->Histories->Units->find('list');
        $this->set(compact('history', 'contacts', 'groups', 'events', 'units'));
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
        $history = $this->Histories->get(
            $id,
            [
            'contain' => []
            ]
        );
        if ($this->Auth->user('id') ==  $history->user_id) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $history = $this->Histories->patchEntity($history, $this->request->getData());
                if ($this->Histories->save($history)) {
                    $this->Flash->success('The history has been saved.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The history could not be saved. Please, try again.'));
                }
            }
            $contacts = $this->Histories->Contacts->find('list');
            $users = $this->Histories->Users->find('list');
            $groups = $this->Histories->Groups->find('list');
            $events = $this->Histories->Events->find('list');
            $units = $this->Histories->Units->find('list');
            $this->set(compact('history', 'contacts', 'users', 'groups', 'events', 'units'));
        } else {
            $this->Flash->error(__('You do not have permission to edit.'));
            return $this->redirect(['action' => 'index']);
        }
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
        $history = $this->Histories->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Histories->delete($history)) {
            $this->Flash->success('The history has been deleted.');
        } else {
            $this->Flash->error('The history could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function get_detail($id)
    {
        //TODO add test case
        //TODO check if the user has access to this history data
        $result = $this->Histories->find()
            ->select(['detail'])
            ->where(['id' => $id])
            ->toArray('assoc');
        $result = $result[0];
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
