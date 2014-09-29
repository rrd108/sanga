<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Eventgroup Entity.
 */
class Eventgroup extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'events' => true,
	];

}
