<?php

namespace App\Model\Table;

use ArrayObject;
use App\Model\Entity\Album;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Albums Model
 *
 * @property \Cake\ORM\Association\belongsTo $Artists
 * @property \Cake\ORM\Association\hasMany $Songs 
 */
class AlbumsTable extends Table
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


        $this->setTable('albums');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Songs', [
            'foreignKey' => 'album_id',
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
            ->date('release_date')
            ->requirePresence('release_date', 'create')
            ->notEmptyDate('release_date');

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
        $rules->add($rules->existsIn(['artist_id'], 'Artists'));

        return $rules;
    }
}
