<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 */
class GroupsTable extends Table
{

/**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo(
            'AdminUsers',
            [
            'className' => 'Users',
            'foreignKey' => 'admin_user_id',
            ]
        );
        $this->hasMany(
            'Histories',
            [
            'foreignKey' => 'group_id',
            'sort' => ['Histories.date' => 'DESC']
            ]
        );
        $this->belongsToMany(
            'Contacts',
            [
            'foreignKey' => 'group_id',
            'targetForeignKey' => 'contact_id',
            'joinTable' => 'contacts_groups',
            'sort' => 'Contacts.contactname'
            ]
        );
        $this->belongsToMany(
            'Users',
            [
            'through' => 'groups_users'
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
        ->notEmpty('name')
        ->allowEmpty('description')
        ->add('admin_user_id', 'valid', ['rule' => 'numeric'])
        ->allowEmpty('admin_user_id')
        ->add('shared', 'valid', ['rule' => 'boolean'])
        ->allowEmpty('shared');

        return $validator;
    }

/**
* Find accessible groups for the user
*
* @param  Cake\ORM\Query $query
* @param  array $options Options for filter matching, 'User.id' should be present
*                     User.id    -    we seraching the accessible groups for this user
*                     shared    -    if set the result will include shared groups
* @return Cake\ORM\Query $query
*/
    public function findAccessible(Query $query, array $options)
    {
        if (isset($options['shared'])) {
            $shared = ['shared' => true];
        } else {
            $shared = null;
        }
        $memberInGroup = $this->findWhereMember($query, $options);
        if ($memberInGroup) {
            $query->orWhere(['Groups.id IN' => $memberInGroup]);
        }
        return $query
          ->orWhere($shared)
          ->orWhere(['admin_user_id' => $options['User.id']])
          ->order(['Groups.name']);
    }

    private function findWhereMember(Query $query, array $options)
    {
        $_query = $this->query($query);
        $memberships = $_query->matching(
            'Users',
            function ($q) use ($options) {
                  return $q->where(['Users.id' => $options['User.id']]);
            }
        );
        $memberInGroup = [];
        foreach ($memberships as $m) {
            $memberInGroup[] = $m->id;
        }
        return $memberInGroup;
    }

    /**
     * Is the given user the admin of the given group
     *
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isAdmin($userId, $groupId)
    {
        $group = $this->find()
            ->select('admin_user_id')
            ->where(['id' => $groupId])
            ->toArray();
        if(isset($group[0]) && $group[0]['admin_user_id'] == $userId) {
            return true;
        }
        return false;
    }

    /**
     * The given user has write access to the given group
     *
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isWritable($userId, $groupId)
    {
        $group = $this->find()
            ->where(['Groups.id' => $groupId])
            ->innerJoinWith('Users',
                function ($q) use ($userId) {
                    return $q->where(['Users.id' => $userId]);
                })
            ->toArray();
        if(isset($group[0]) && $group[0]['id'] == $groupId) {
            return true;
        } else {
            return $this->isAdmin($userId, $groupId);
        }
        return false;
    }

    /**
     * Is the group readable by the user
     *
     * It is readable if it it shared, or writable
     *
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isReadable($userId, $groupId)
    {
        $group = $this->find()
            ->where(['Groups.id' => $groupId])
            ->toArray();
        if(isset($group[0]) && $group[0]['shared']) {
            return true;
        }
        if($this->isWritable($userId, $groupId)) {
            return true;
        }
        return false;
    }
}
