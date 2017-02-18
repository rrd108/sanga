<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class DuplicateFilterShell extends Shell
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Contacts');
    }
    
    public function main($owner = 0)
    {
        $this->Contacts->checkDuplicates($owner);
    }
    
    //TODO search and delete families with one member family_id is only for one contact
}
