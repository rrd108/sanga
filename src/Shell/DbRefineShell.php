<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

class DbRefineShell extends Shell {
	
	public function initialize() {
        parent::initialize();
        $this->loadModel('Contacts');
    }
	
    public function main() {
		$this->getContactsGeo();
    }
	
	public function getContactsGeo(){
		$result = $this->Contacts->find()
				->contain(['Zips', 'Countries'])
				->select(['Contacts.id', 'Contacts.address', 'Zips.zip', 'Zips.name', 'Countries.name'])
				->where('Contacts.lat = 0')
				->toArray();
		
		foreach($result as $r){
			$this->saveGeo($this->getGeo($r));
			sleep(2);
		}
		
	}
	
	public function saveGeo($latLngContact){
		$contactsTable = $articles = TableRegistry::get('Contacts');
		$contact = $this->Contacts->get($latLngContact['id']);
		$contact->lat = $latLngContact['lat'];
		$contact->lng = $latLngContact['lng'];
		if($contactsTable->save($contact)){
			$this->out('Success: ' . $latLngContact['id']);
		}
		else{
			$this->out('Error: ' . $latLngContact['id']);
		}
	}
	
	public function getGeo($data){
		//debug($data);
		$googleApiKey = 'AIzaSyCaw8aQw14f-cLB3Li5Aak2huu9Ey5KwP8';
		$geourl = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$googleApiKey.
				'&address='.urlencode($data->country->name . '+' . 
									  $data->zip->zip . '+' . 
									  $data->zip->name . '+' . 
									  $data->address);
		//debug($geourl);
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $geourl);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$json = json_decode(trim(curl_exec($c)));
		curl_close($c);
		
		$this->out('Status : ' . $json->status);
		return(['id' => $data->id,
				'lat' => $json->results[0]->geometry->location->lat,
				'lng' => $json->results[0]->geometry->location->lng]);		
		}
}
?>