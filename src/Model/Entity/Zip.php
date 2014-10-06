<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Zip Entity.
 */
class Zip extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'country_id' => true,
		'zip' => true,
		'name' => true,
		'lat' => true,
		'lng' => true,
		'contacts' => true,
	];

    protected function _getFullZip() {
        return $this->_properties['zip'] . '  ' .
            $this->_properties['name'];
    }
}
