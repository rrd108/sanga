<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
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
        $query = $this->Notifications->find()
            ->where(['user_id' => $this->Auth->user('id'), 'unread' => true])
            ->order(['Notifications.created' => 'DESC'])
            ->contain(['Senders']);
        $this->set('newNotifications', $this->paginate($query));

        $query = $this->Notifications->find()
            ->where(['user_id' => $this->Auth->user('id'), 'unread' => false])
            ->order(['Notifications.created' => 'DESC'])
            ->contain(['Senders']);
        $this->set('readNotifications', $this->paginate($query));

        $query = $this->Notifications->find()
            ->where(['sender_id' => $this->Auth->user('id')])
            ->order(['Notifications.created' => 'DESC'])
            ->contain(['Users']);
        $this->set('sentNotifications', $this->paginate($query));
    }

    /**
 * View method
 *
 * Viewing a notification by its owner sets unread to false
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function view($id = null)
    {
        $notification = $this->Notifications->get(
            $id,
            [
            'contain' => ['Senders']
            ]
        );
        if ($notification->user_id == $this->Auth->user('id')) {
            $notification->unread = false;
            $this->Notifications->save($notification);
        }
        $this->set(
            'notification_count',
            ($this->Notifications->find('unread', ['User.id' => $this->Auth->user('id')])->count()));
        $this->set('notification', $notification);
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add($user_id = null)
    {
        $notification = $this->Notifications->newEntity($this->request->getData());
        if ($user_id) {
            $notification->user_id = $user_id;
        } else {
            $notification->user_id = $notification->user_id ? $notification->user_id : $this->Auth->user('id');
        }
        if ($this->request->is('post')) {
            $notification->sender_id = $this->Auth->user('id');
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list');
        $this->set(compact('notification', 'users'));
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
        $notification = $this->Notifications->get(
            $id,
            [
            'contain' => []
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list');
        $this->set(compact('notification', 'users'));
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
        $notification = $this->Notifications->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
