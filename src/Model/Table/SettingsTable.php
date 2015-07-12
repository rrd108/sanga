<?php
namespace App\Model\Table;

use App\Model\Entity\Setting;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 */
class SettingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param  array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('settings');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo(
            'Users',
            [
            'foreignKey' => 'user_id'
            ]
        );
    }

    /**
     * Default validation rules.
     *
     * @param  \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->allowEmpty('name')
            ->allowEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param  \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    /**
     * Returns saved queries for the user
     *
     * @param int $userId The id of the user
     * @return Query
     */
    public function getSavedQueries($userId)
    {
        return $this->find()
            ->where(['user_id' => $userId, 'name' => 'Contacts/searchquery'])
            ->order(['value' => 'ASC']);
    }

    /**
     * Returns default groups' ids
     *
     * @return array of default groups' ids or null if there are no default groups
     */
    public function getDefaultGroups()
    {
        $defaultGroups = $this->find()
            ->select(['value'])
            ->where(
                [
                    'user_id' => 1,
                    'name' => 'default_groups'
                ]
            )
            ->toArray();
        if (!isset($defaultGroups[0])) {
            return null;
        }
        $defaultGroups = $defaultGroups[0];
        return unserialize($defaultGroups->value);
    }
}
