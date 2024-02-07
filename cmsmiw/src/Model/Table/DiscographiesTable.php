<?php

namespace App\Model\Table;

use ArrayObject;
use App\Model\Entity\Discography;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Event\Event; 
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Discographies Model
 *
 * @property \Cake\ORM\Association\hasMany $Artists 
 */
class DiscographiesTable extends Table
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

        $this->setTable('discographies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->hasMany('Artists', [
            'foreignKey' => 'discography_id',
        ]);
    }

    /**
     * Modifies the structure of the data that will be passed to the patchEntity
     *
     * @param  \Cake\Event\Event $event   The beforeMarshal event that was fired.
     * @param  \ArrayObject      $options The data of the entity
     * @param  \ArrayObject      $options The options for the query
     *
     * @return void
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    { 
       // $data['launch_date'] = new Time($data['launch_date']);
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
            ->requirePresence('country', 'create')
            ->notEmptyString('country');

        $validator
            ->date('launch_date')
            ->requirePresence('launch_date', 'create') 
            ->notEmptyDate('launch_date');

         


        return $validator;
    }
}
