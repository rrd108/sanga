<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 */
class EventsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->setTable('events');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo(
            'Users',
            [
            'foreignKey' => 'user_id',
            ]
        );
        $this->hasMany(
            'Histories',
            [
            'foreignKey' => 'event_id',
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
            ->allowEmpty('name')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id');

        return $validator;
    }
}
