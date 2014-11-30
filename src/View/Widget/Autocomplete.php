<?php
namespace App\View\Widget;

use Cake\View\Widget\WidgetInterface;
use Cake\View\Form\ContextInterface;
use Cake\Routing\Router;

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
            'value' => '',
            'focus' => 'event.preventDefault();',     //without this when we select something its value will be written into the input
            'change' => '',
            'onSelect' => 'value'
        ];
        $data['source'] = ltrim($data['source'], '/');
        
        /* 
         * multiple choices gets id like: skills._ids
         * it rendered as id="#skills[ids]"
         * jQuery does not find $("#skills[ids]"), because of the "[" spec char
         * so we should escape it by double "\\"
         * so the seletor will be $("#_skills\\[_ids\\]")
         */
        $safeName = str_replace('[', '\\\\[', $data['name']);
        $safeName = str_replace(']', '\\\\]', $safeName);
        
        $focus = $data['focus'];
        $change = $data['change'];
        $onSelect = $data['onSelect'];
        unset($data['focus'], $data['change'], $data['onSelect']);
        
        if($onSelect == 'value'){
            return $this->_templates->format('autocompleteOnSelectValue', [
                'name' => $data['name'],
                'safeName' => $safeName,
                'label' => $data['label'],
                'source' => Router::url('/') . $data['source'],
                'value' => $data['val'],
                'focus' => $focus,
                'change' => $change,
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source', 'value']
                                                               )
            ]);
        }
        else{
            return $this->_templates->format('autocompletechecker', [
                'name' => $data['name'],
                'safeName' => $safeName,
                'label' => $data['label'],
                'source' => Router::url('/') . $data['source'],
                'value' => $data['val'],
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source', 'value']
                                                               )
            ]);
        }
    }
    
    public function secureFields(array $data){
       return []; 
    }
}
?>