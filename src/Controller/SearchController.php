<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\String;

class SearchController extends AppController {
	
	public function isAuthorized($user = null) {
        return true;
    }

	public function quicksearch(){
		$this->Contacts = TableRegistry::get('Contacts');
		$contact = $this->Contacts->newEntity($this->request->data);
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname', 'email', 'phone'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['email LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['phone LIKE "%'.$this->request->query('term').'%"']);
		//debug($query->toArray());
		foreach($query as $row){
			$label = $this->createHighlight($row->name) . ' ' .
					$this->createHighlight($row->contactname) . ' ' .
					$this->createHighlight($row->email) . ' ' .
					$this->createHighlight($row->phone);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		//debug($result);die();
		
		//groups
		
		//histories
		
		$this->set('result', $result);
	}

	private function createHighlight($value = null){
		if ($value && strpos(strtolower($value), $this->request->query('term')) !== false) {
			$highlight = array('format' => '<span class="b i">\1</span>');
			return String::highlight($value, $this->request->query('term'), $highlight) . ' ';
		} else {
			return $value;
		}
	}
}