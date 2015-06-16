<?php
namespace App\View\Cell;

use Cake\View\Cell;

class NotificationCell extends Cell
{

    public function display($userId)
    {
        $this->loadModel('Notifications');
        $notification_count = $this->Notifications->find('unread', ['User.id' => $userId])->count();
        $this->set('notification_count', $notification_count);
    }
}
