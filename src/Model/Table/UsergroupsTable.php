<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Usergroups Model
 */
class UsergroupsTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->table('usergroups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo(
            'AdminUsers',
            [
            'className' => 'Users',
            'foreignKey' => 'admin_user_id',
            ]
        );
        $this->belongsToMany(
            'Users',
            [
            'foreignKey' => 'usergroup_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_usergroups',
            'sort' => 'Users.name'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('admin_user_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('admin_user_id', 'create')
            ->notEmpty('admin_user_id');

        return $validator;
    }

    public function findOwnedBy(Query $query, array $options)
    {
        return $query
            ->where(['Usergroups.admin_user_id' => $options['User.id']])
            ->contain(
                [
                    'AdminUsers',
                    'Users'
                ]
            )
            ->order(['Usergroups.name']);
    }

    public function findMemberships(Query $query, array $options)
    {
        return $query
            ->contain(['AdminUsers', 'Users'])
            ->innerJoinWith(
                'Users',
                function ($q) use ($options) {
                    return $q->where(['Users.id' => $options['User.id']]);
                }
            );
    }

    /**
     * @param int $groupId
     * @param int $userId
     * @return bool|\Cake\Datasource\EntityInterface|mixed
     */
    public function join(int $groupId, int $userId)
    {
        $usergroup = $this->get($groupId, ['contain' => ['Users']]);

        $members = Hash::extract($usergroup, 'users.{n}.id');

        $canJoin = array_search($userId, $members);

        if ($canJoin !== false) {
            $usergroup->users[$canJoin]->_joinData->joined = true;
            $usergroup->dirty('users', true);
            return $this->save($usergroup, ['associated' => ['Users']]);
        }
    }
}
