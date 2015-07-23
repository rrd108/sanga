<?php

use Cake\ORM\TableRegistry;
use Cake\Event\EventManager;

$notifications = TableRegistry::get('Notifications');
//we need the global EventManager to listen as the venet comes from a different model
EventManager::instance()->on($notifications);
