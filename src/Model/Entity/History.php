<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * History Entity.
 */
class History extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'date' => true,
		'contact_id' => true,
		'user_id' => true,
		'detail' => true,
		'amount' => true,
		'event_id' => true,
		'group_id' => true,
		'contact' => true,
		'user' => true,
		'event' => true,
		'group' => true,
	];

}
