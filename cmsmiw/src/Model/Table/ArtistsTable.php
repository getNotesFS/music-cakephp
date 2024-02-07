<?php

namespace App\Model\Table;

use ArrayObject;
use App\Model\Entity\Artist;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Artists Model
 *
 * @property \Cake\ORM\Association\belongsTo $Discographies
 * @property \Cake\ORM\Association\hasMany $Albums 
 */
class ArtistsTable extends Table
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

        $this->setTable('artists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Albums', [
            'foreignKey' => 'artist_id',
        ]);

        $this->belongsTo('Discographies', [
            'foreignKey' => 'discography_id',
            'joinType' => 'INNER' 
        ]);
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

        $validator
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->requirePresence('biography', 'create')
            ->notEmptyString('biography');

        $validator
            ->requirePresence('country', 'create')
            ->notEmptyString('country');

        $validator
            ->integer('age')
            ->allowEmpty('age');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['discography_id'], 'Discographies'));  

        return $rules;
    }
}
