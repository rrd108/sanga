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
    
    public function main()
    {
        $this->Contacts->checkDuplicatesOnPhone();
    }
    
    //TODO search and delete families with one member family_id is only for one contact
}
