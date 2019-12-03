<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

class SearchController extends AppController
{
    public function isAuthorized($user = null)
    {
        return true;
    }

    public function quicksearch()
    {
        $this->Contacts = TableRegistry::get('Contacts');

        $term = $this->request->getQuery('term') . $this->request->getData('quickterm');

        // TODO find only accessible
        // TODO replace this tofunc call for better security
        $query = $this->Contacts->find()
            ->select(['id', 'contactname', 'legalname', 'email', 'phone', 'birth', 'workplace', 'comment'])
            ->where(['contactname LIKE "%'.$term.'%"'])
            ->orWhere(['legalname LIKE "%'.$term.'%"'])
            ->orWhere(['email LIKE "%'.$term.'%"'])
            ->orWhere(['phone LIKE "%'.$term.'%"'])
            ->orWhere(['comment LIKE "%'.$term.'%"'])
            ->orWhere(['workplace LIKE "%'.$term.'%"']);
        foreach ($query as $row) {
            $label = '';
            if ($this->Contacts->isAccessible($row->id, $this->Auth->user('id'))) {
                if ($this->createHighlight($row->contactname, $term) || $this->createHighlight($row->legalname, $term)) {
                    $label .= '<span class="noaccess">';
                    $label .= $this->createHighlight($row->contactname, $term) ? '♥ ' . $this->createHighlight($row->contactname, $term) . ' ' : '';
                    $label .= $this->createHighlight($row->legalname, $term) ? '♥ ' . $this->createHighlight($row->legalname, $term) . ' ' : '';
                    $label .= '</span>';
                }
                if ($row->contactname) {
                    $label .= $this->createHighlight($row->contactname, $term) ? '♥ ' . $this->createHighlight($row->contactname, $term) . ' ' : '♥ ' . $row->contactname . ' ';
                }
                if ($row->legalname) {
                    $label .= $this->createHighlight($row->legalname, $term) ? '♥ ' . $this->createHighlight($row->legalname, $term) . ' ' : '♥ ' . $row->legalname . ' ';
                }
                $label .= $this->createHighlight($row->email, $term) ? '✉ ' . $this->createHighlight($row->email, $term) . ' ' : '';
                $label .= $this->createHighlight($row->phone, $term) ? '☏ ' . $this->createHighlight($row->phone, $term) . ' ' : '';
                $label .= (isset($row->birth) && $this->createHighlight($row->birth, $term)) ? '↫ ' . $this->createHighlight($row->birth, $term) . ' ' : '';
                $label .= $this->createHighlight($row->workplace, $term) ? '♣ ' . $this->createHighlight($row->workplace, $term) . ' ' : '';
                $label .= $this->createHighlight($row->comment, $term) ? '✍ ' : '';
            }
            if ($label) {
                $result[] = [
                    'value' => 'c'.$row->id,
                    'label' => $label
                ];
            }
        }

        //groups
        $this->Groups = TableRegistry::get('Groups');
        $query = $this->Groups->find(
            'accessible',
            [
                'User.id' => $this->Auth->user('id'),
                'shared' => true
            ]
        )
            ->where(['name LIKE "'.$term.'%"']);
        foreach ($query as $row) {
            if ($this->createHighlight($row->name, $term)) {
                $label = '⁂ ' . $this->createHighlight($row->name, $term);
                $result[] = [
                    'value' => 'g' . $row->id,
                    'label' => $label
                ];
            }
        }

        //skills
        $this->Skills = TableRegistry::get('Skills');
        $query = $this->Skills
            ->find()
            ->where(['name LIKE "'.$term.'%"']);
        //debug($query->toArray());die();
        foreach ($query as $row) {
            if ($this->createHighlight($row->name, $term)) {
                $label = '✄ ' . $this->createHighlight($row->name, $term);
                $result[] = [
                    'value' => 's' . $row->id,
                    'label' => $label
                ];
            }
        }

        //histories
        //too many entries
        /*$this->Histories = TableRegistry::get('Histories');
        $query = $this->Histories->find()
                ->select(['id', 'detail'])
                ->where(['detail LIKE "'.$this->request->query('term').'%"']);
        foreach($query as $row) {
            $label = '⚑ ' . $this->createHighlight($row->detail);
            $result[] = array('value' => $row->id,
                              'label' => $label);
        }*/

        $this->set(compact('result', 'term'));
        $this->set('_serialize', 'result');
    }

    private function createHighlight($value = null, $term)
    {
        //sql returns ékezetes, but this one not
        $highlight = ['format' => '<span class="b i">\1</span>'];
        //remove % from beginning
        if (strpos($value, '%') === 0) {
            $value = substr($value, 1);
        }
        if (strpos($term, '%') === 0) {
            $term = substr($term, 1);
        }
        if ($value && mb_strpos(mb_strtolower($value), $term) !== false) {
            return Text::highlight($value, $term, $highlight);
        } else {
            return null;
        }
    }
}
