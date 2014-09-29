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
		'detail' => true,
		'amount' => true,
		'group_id' => true,
		'contact' => true,
		'user' => true,
		'event' => true,
		'group' => true,
	];

}
