<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity.
 */
class Notification extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'notification' => true,
        'users_id' => true,
		'unread' => true,
		'user' => true,
	];

}
