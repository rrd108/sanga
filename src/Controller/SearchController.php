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
				->select(['id', 'contactname', 'legalname', 'email', 'phone', 'birth', 'workplace'])
				->where(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['legalname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['email LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['phone LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['birth LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['workplace LIKE "%'.$this->request->query('term').'%"']);
		//debug($query->toArray());
		foreach($query as $row) {
			if ( ! $this->Contacts->isAccessible($row->id, $this->Auth->user('id'))) {
				$label = '<span class="noaccess">';
					$label .= $this->createHighlight($row->contactname) ? '♥ ' . $this->createHighlight($row->contactname) : '';
					$label .= $this->createHighlight($row->leaglname) ? '♥ ' . $this->createHighlight($row->legalname) : '';
				$label .= '</span>';
			} else {
				$label = $this->createHighlight($row->contactname, false) ? '♥ ' . $this->createHighlight($row->contactname, false) : '';
			}
			if ( $this->Contacts->isAccessible($row->id, $this->Auth->user('id'))) {
				$label .= $this->createHighlight($row->legalname) ? '♥ ' . $this->createHighlight($row->legalname) . ' ' : '';
				$label .= $this->createHighlight($row->email) ? '✉ ' . $this->createHighlight($row->email) . ' ' : '';
				$label .= $this->createHighlight($row->phone) ? '☏ ' . $this->createHighlight($row->phone) . ' ' : '';
				$label .= (isset($row->birth) && $this->createHighlight($row->birth)) ? '↫ ' . $this->createHighlight($row->birth->format('Y-m-d')) . ' ' : '';
				$label .= $this->createHighlight($row->workplace) ? '♣ ' . $this->createHighlight($row->workplace) : '';
			}
			$result[] = array('value' => 'c'.$row->id,
							  'label' => $label);
		}
		
		//groups
		$this->Groups = TableRegistry::get('Groups');
		$query = $this->Groups->find('accessible',
									 ['User.id' => $this->Auth->user('id'),
									  'shared' => true])
				->where(['name LIKE "%'.$this->request->query('term').'%"']);
		foreach($query as $row) {
			$label = '⁂ ' . $this->createHighlight($row->name);
			$result[] = array('value' => 'g'.$row->id,
							  'label' => $label);
		}
		
		//histories
		//too many entries
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
		$this->set('_serialize', 'result');
	}

	private function createHighlight($value = null, $filterout = true){
		if ($filterout) {
			if ($value && mb_strpos(mb_strtolower($value), $this->request->query('term')) !== false) {
				$highlight = array('format' => '<span class="b i">\1</span>');
				return String::highlight($value, $this->request->query('term'), $highlight);
			} else {
				return '';
			}
		} else {
			if ($value && mb_strpos(mb_strtolower($value), $this->request->query('term')) !== false) {
				$highlight = array('format' => '<span class="b i">\1</span>');
				return String::highlight($value, $this->request->query('term'), $highlight);
			} else {
				return $value;
			}
		}
	}
}