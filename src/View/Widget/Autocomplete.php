<?php
namespace App\View\Widget;

use Cake\View\Widget\WidgetInterface;
use Cake\View\Form\ContextInterface;

class Autocomplete implements WidgetInterface {

    protected $_templates;

    public function __construct($templates) {
        $this->_templates = $templates;
    }

    public function render(array $data, ContextInterface $context) {
        $data += [
            'name' => '',
            'label' => '',
            'source' => '',
            'select' => true
        ];
        if($data['select']){
            return $this->_templates->format('autocompleteselect', [
                'name' => $data['name'],
                'label' => $data['label'],
                'source' => '../' . $data['source'],
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source']
                                                               )
            ]);
        }
        else{
            return $this->_templates->format('autocompletechecker', [
                'name' => $data['name'],
                'label' => $data['label'],
                'source' => '../' . $data['source'],
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source']
                                                               )
            ]);
        }
    }
    
    public function secureFields(array $data){
       return []; 
    }
}
?>