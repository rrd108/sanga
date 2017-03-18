<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Histories Model
 */
class HistoriesTable extends Table
{

    /**
 * Initialize method
 *
 * @param  array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config)
    {
        $this->setTable('histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo(
            'Contacts',
            [
            'foreignKey' => 'contact_id',
            ]
        );
        $this->belongsTo(
            'Users',
            [
            'foreignKey' => 'user_id',
            ]
        );
        $this->belongsTo(
            'Groups',
            [
            'foreignKey' => 'group_id',
            ]
        );
        $this->belongsTo(
            'Events',
            [
            'foreignKey' => 'event_id',
            ]
        );
        $this->belongsTo(
            'Units',
            [
            'foreignKey' => 'unit_id',
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
            ->add('contact_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('contact_id', 'create')
            ->notEmpty('contact_id')
            ->add('date', 'valid', ['rule' => 'date'])
            ->notEmpty('date')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id')
            ->add('group_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('group_id')
            ->add('event_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('event_id', 'create')
            ->notEmpty('event_id')
            ->allowEmpty('detail')
            ->add('quantity', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('quantity')
            ->add('unit_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('unit_id')
            ->add('family', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('family');

        return $validator;
    }

    /**
 * Find histories owned by given user(s)
 * The given users are the contact persons for the contact
 */
    public function findOwnedBy(Query $query, array $options)
    {
        return $query
            ->innerJoinWith(
                'Users',
                function ($q) use ($options) {
                        return $q->where(['Users.id IN ' => $options['User.id']]);
                }
            );
    }


    /**
     * Find histories what are created by the given user
     *  or by an other user who is a member of a usergroup
     *  where the given user is admin
     *
     * @param Query $query
     * @param array $options
     * @return Query $query
     */
    public function findAccessibleBy(Query $query, array $options)
    {
        $queryTemp1 = $query->cleanCopy();
        $queryTemp2 = $query->cleanCopy();

        //get own
        $owned = $this->findOwnedBy($queryTemp1, $options);

        //get user_id-s from usergroups where the given user is admin
        $userIds = $this->Users->find()
            ->select(['Users.id'])
            ->innerJoinWith(
                'Usergroups',
                function ($q) use ($options) {
                    return $q->where(['Usergroups.admin_user_id' => $options['User.id']]);
                }
            )
            ->setHydrate(false)
            ->extract('id')
            ->toArray();
        if (empty($userIds)) {
            $userIds = [0];
        }

        $accessibleViaUserGroups = $queryTemp2->innerJoinWith(
            'Users',
            function ($q) use ($userIds) {
                return $q->where(['Users.id IN ' => $userIds]);
            }
        );

        if (isset($options['_contain'])) {
            $owned->contain($options['_contain']);
            $accessibleViaUserGroups->contain($options['_contain']);
        }

        $accessible = $owned->union($accessibleViaUserGroups);

        $accessibleCount = $accessible->count();
        $accessible->counter(function ($query) use ($accessibleCount) {
            return $accessibleCount;
        });

        $order = '';
        if (isset($options['_order'])) {
            foreach ($options['_order'] as $field => $ascdesc) {
                $order .= ' ' . str_replace('.', '__', $field) . ' ' . $ascdesc . ',';
            }
            if ($order) {
                $order = 'ORDER BY' . rtrim($order, ',');
            }
        }

        $limit = 25;
        if (isset($options['_limit'])) {
            if ($options['_limit'] !== false) {
                $limit = $options['_limit'];
            } else {
                $limit = '';
            }
        }
        if ($limit) {
            $page = isset($options['_page']) ? $options['_page'] : 1;
            $offset = $limit * ($page - 1);
            $limit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $accessible->epilog($order . $limit);
        return $accessible;
    }
}
