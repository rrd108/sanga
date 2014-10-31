<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usergroup Entity.
 */
class Usergroup extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'admin_user_id' => true,
		'users' => true,
	];

}
