<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity.
 */
class Group extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'user_id' => true,
		'grouptype' => true,
		'histories' => true,
		'contacts' => true,
	];

}
