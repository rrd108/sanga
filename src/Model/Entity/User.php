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
		'resettoken' => true,
		'events' => true,
		'groups' => true,
		'histories' => true,
		'notifications' => true,
		'google_contacts_refresh_token' => true,
		'last_login' => true,
		'contacts' => true,
		'usergroups' => true,
	];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
