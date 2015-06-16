<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

use Cake\Core\Configure;

class HistoryShell extends Shell
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Histories');
        $this->loadModel('Notifications');
    }
    
    public function main()
    {
        $history = json_decode($this->args[0], true);
        $history['date'] = substr($history['date'], 0, 10);
        //Log::debug($history);
        $group = json_decode($this->args[1], true);
        //Log::debug($group);
        foreach ($group['contacts'] as $contact) {
            //Log::debug($contact);
            $history['contact_id'] = $contact['id'];
            //Log::debug($history);
            $historyEntity = $this->Histories->newEntity($history);
            //Log::debug($historyEntity);
            if (! $this->Histories->save($historyEntity)) {
                $notification = [
                    'user_id' => $this->args[2],
                    'sender_id' => 1,
                    'notification' => __('History event was not added for {0}', h($contact['contactname']))
                    ];
                //Log::debug($historyEntity->errors());
                $notification = $this->Notifications->newEntity($notification);
                //Log::debug($notification);
                $this->Notifications->save($notification);
            }
        }
    }
}
