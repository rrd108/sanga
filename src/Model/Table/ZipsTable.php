<?php
namespace App\Model\Table;

use App\Model\Entity\Zip;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Zips Model
 */
class ZipsTable extends Table
{

    /**
     * Initialize method
     *
     * @param  array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('zips');
        $this->displayField('zip');     //fullzip
        $this->primaryKey(['id']);
        $this->belongsTo(
            'Countries',
            [
            'foreignKey' => 'country_id'
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
            ->notEmpty('zip')
            ->notEmpty('name')
            ->allowEmpty('lat')
            ->allowEmpty('lng');

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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
    
    public function getIdForZip($zip)
    {
        if (is_array($zip)) {
            $where = ['zip' => $zip[0], 'name' => $zip[1]];
        } else {
            $where = ['zip' => $zip];
        }
        $id = $this->find()->select('id')->where($where)->first();
        if (isset($id->id)) {
            return $id->id;
        } else {
            return;
        }
    }
}
