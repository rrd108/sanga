<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersUsergroups Model
 */
class UsersUsergroupsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->setTable('users_usergroups');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['user_id', 'usergroup_id']);
        $this->addBehavior('Timestamp');

        $this->belongsTo(
            'Users',
            [
            'foreignKey' => 'user_id',
            ]
        );
        $this->belongsTo(
            'Usergroups',
            [
            'foreignKey' => 'usergroup_id',
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
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id')
            ->add('usergroup_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('usergroup_id');
        return $validator;
    }
}
