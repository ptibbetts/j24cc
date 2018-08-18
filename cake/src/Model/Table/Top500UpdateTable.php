<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Top500Update Model
 *
 * @method \App\Model\Entity\Top500Update get($primaryKey, $options = [])
 * @method \App\Model\Entity\Top500Update newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Top500Update[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Top500Update|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Top500Update|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Top500Update patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Top500Update[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Top500Update findOrCreate($search, callable $callback = null, $options = [])
 */
class Top500UpdateTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('top500_updates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }
}
