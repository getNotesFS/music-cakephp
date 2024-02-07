<?php

namespace App\Model\Table;

use ArrayObject;
use App\Model\Entity\Playlist;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Playlists Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Genders
 * @property \Cake\ORM\Association\BelongsToMany $Songs
 */
class PlaylistsTable extends Table
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

        $this->setTable('playlists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
        ]);

        $this->belongsToMany('Songs', [
            'foreignKey' => 'playlist_id',
            'targetForeignKey' => 'song_id',
            'joinTable' => 'songs_playlists',
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
            ->integer('gender_id')
            ->requirePresence('gender_id', 'create')
            ->notEmpty('gender_id');

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
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        return $rules;
    }
}
