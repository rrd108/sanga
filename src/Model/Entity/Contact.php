<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity.
 */
class Contact extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'contactname' => true,
        'zip_id' => true,
        'address' => true,
        'lat' => true,
        'lng' => true,
        'phone' => true,
        'email' => true,
        'birth' => true,
        'sex' => true,
        'workplace' => true,
        'workplace_zip_id' => true,
        'workplace_address' => true,
        'workplace_phone' => true,
        'workplace_email' => true,
        'family_id' => true,
        'contactsource_id' => true,
        'active' => true,
        'comment' => true,
        'google_id' => true,
        'zip' => true,
        'workplace_zip' => true,
        'family' => true,
        'contactsource' => true,
        'google' => true,
        'histories' => true,
        'groups' => true,
        'skills' => true,
        'users' => true,
    ];
}
