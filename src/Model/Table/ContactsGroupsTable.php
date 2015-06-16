<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactsGroups Model
 */
class ContactsGroupsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->table('contacts_groups');
        $this->displayField('group_id');
        $this->primaryKey(['group_id', 'contact_id']);

        $this->belongsTo(
            'Groups',
            [
            'foreignKey' => 'group_id',
            ]
        );
        $this->belongsTo(
            'Contacts',
            [
            'foreignKey' => 'contact_id',
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
            ->add('group_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('group_id', 'create')
            ->add('contact_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('contact_id', 'create');

        return $validator;
    }
}
