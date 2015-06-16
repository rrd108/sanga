<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersUsergroup Entity.
 */
class UsersUsergroup extends Entity
{

    /**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
    protected $_accessible = [
        'id' => true,
        'admin' => true,
        'user' => true,
        'usergroup' => true,
    ];
}
