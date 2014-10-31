<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupsUser Entity.
 */
class GroupsUser extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'id' => true,
		'intersection_group_id' => true,
		'group' => true,
		'user' => true,
	];

}
