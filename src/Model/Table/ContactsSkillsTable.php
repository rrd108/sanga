<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactsSkills Model
 */
class ContactsSkillsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->table('contacts_skills');
        $this->displayField('contact_id');
        $this->primaryKey(['contact_id', 'skill_id']);

        $this->belongsTo(
            'Contacts',
            [
            'foreignKey' => 'contact_id',
            ]
        );
        $this->belongsTo(
            'Skills',
            [
            'foreignKey' => 'skill_id',
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
            ->add('contact_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('contact_id', 'create')
            ->add('skill_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('skill_id', 'create');

        return $validator;
    }
}
