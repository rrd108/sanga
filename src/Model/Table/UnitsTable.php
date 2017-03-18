<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Units Model
 */
class UnitsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->setTable('units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany(
            'Histories',
            [
            'foreignKey' => 'unit_id',
            'sort' => ['Histories.date' => 'DESC']
            ]
        );
    }

    /**
 * Default validation rules.
 *
 * @param  \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->allowEmpty('name');

        return $validator;
    }
}
