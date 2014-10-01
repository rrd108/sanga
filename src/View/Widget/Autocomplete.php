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
            'source' => ''
        ];
        return $this->_templates->format('autocomplete', [
            'name' => $data['name'],
            'label' => $data['label'],
            'source' => $data['source'],
            'title' => $data['title'],
            'attrs' => $this->_templates->formatAttributes($data, ['name', 'label', 'title', 'source'])
        ]);
    }
    
    public function secureFields(array $data){
       return []; 
    }
}
?>