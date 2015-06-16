<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Skills Model
 */
class SkillsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->table('skills');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany(
            'Contacts',
            [
            'foreignKey' => 'skill_id',
            'targetForeignKey' => 'contact_id',
            'joinTable' => 'contacts_skills',
            'sort' => 'Contacts.contactname'
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
