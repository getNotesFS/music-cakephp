<?php

namespace App\Model\Table;

use App\Model\Entity\Song;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property \Cake\ORM\Association\belongsTo $Albums
 * @property \Cake\ORM\Association\belongsTo $Genders
 * @property \Cake\ORM\Association\belongsToMany $Playlists
 * @property \Cake\ORM\Association\belongsTo $Artists
 */
class SongsTable extends Table
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

        $this->setTable('songs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
        ]);

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
        ]);

        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
        ]);

        $this->belongsToMany('Playlists', [
            'foreignKey' => 'song_id',
            'targetForeignKey' => 'playlist_id',
            'joinTable' => 'songs_playlists',
        ]);

        $this->Albums->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
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
            ->requirePresence('link_spotify', 'create')
            ->notEmptyString('link_spotify');

        $validator
            ->integer('gender_id')
            ->requirePresence('gender_id', 'create')
            ->notEmpty('gender_id');

        $validator
            ->integer('album_id')
            ->requirePresence('album_id', 'create')
            ->notEmpty('album_id');

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
        $rules->add($rules->existsIn(['album_id'], 'Albums'));
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));

        return $rules;
    }
}
