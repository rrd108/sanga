<?php

use Cake\ORM\TableRegistry;
use Cake\Event\EventManager;

//at the end of bootstrap.php this file should be call via require

//we need the global EventManager to listen as the event comes from a different model/controller
EventManager::instance()->on(TableRegistry::get('Notifications'));
