<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class DuplicateFilterShell extends Shell {
	
	public function initialize() {
        parent::initialize();
        $this->loadModel('Contacts');
    }
	
/*
 * Searching for duplicates
 * 
 * name			similar [name, contactname]
 * contactname	similar [name, contactname]
 * zip_id		same
 * address		remove non alphanumeric
 * lat			same
 * lng			same
 * phone		remove non numeric, if not start with 00 or +, suppose it is +36 and add it
 * email		same
 * birth		same
 * sex			same
 * workpace		similar
 * 
 */
    public function main() {
		$sameLatLngs = $this->Contacts->find()
				->select(['lat', 'lng', 'db' => 'COUNT(*)'])
				->group(['lat', 'lng'])
				->having(['db > ' => 1]);
		
		foreach($sameLatLngs as $sameLatLng){
			if($sameLatLng->lat){
				$duplicates = $this->Contacts->find()
						->select(['id', 'name'])
						->where([
								 'lat' => $sameLatLng['lat'],
								 'lng' => $sameLatLng['lng']
								]);
				debug($duplicates->toArray());
			}
		}
    }
	
}
?>