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
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname', 'email', 'phone'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['email LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['phone LIKE "%'.$this->request->query('term').'%"']);
		//debug($query->toArray());
		foreach($query as $row) {
			$label = '♥ ' . $this->createHighlight($row->name) . ' ' .
					$this->createHighlight($row->contactname) . ' ' .
					$this->createHighlight($row->email) . ' ' .
					$this->createHighlight($row->phone) . ' ';
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		//debug($result);die();
		
		//groups
		$this->Groups = TableRegistry::get('Groups');
		$query = $this->Groups->find('accessible',
									 ['User.id' => $this->Auth->user('id'),
									  'shared' => true])
				->where(['name LIKE "%'.$this->request->query('term').'%"']);
		foreach($query as $row) {
			$label = '⁂ ' . $this->createHighlight($row->name);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		
		//histories
		//to many entries
		/*$this->Histories = TableRegistry::get('Histories');
		$query = $this->Histories->find()
				->select(['id', 'detail'])
				->where(['detail LIKE "%'.$this->request->query('term').'%"']);
		foreach($query as $row) {
			$label = '⚑ ' . $this->createHighlight($row->detail);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}*/
		
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