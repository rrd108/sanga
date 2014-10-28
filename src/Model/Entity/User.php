<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 */
class User extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'password' => true,
		'realname' => true,
		'email' => true,
		'phone' => true,
		'active' => true,
		'role' => true,
		'histories' => true,
		'notifications' => true,
		'contacts' => true,
		'linkups' => true,
	];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
