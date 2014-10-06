<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Linkup Entity.
 */
class Linkup extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'switched' => true,
		'users' => true,
		'contacts' => true,
	];

}
