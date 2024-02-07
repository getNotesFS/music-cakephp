<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Song Entity. 
 * @property int $id
 * @property int $gender_id
 * @property int $album_id
 * @property \App\Model\Entity\Album $album
 * @property \App\Model\Entity\Gender $gender
 * @property string $name
 * @property string $link_spotify 
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified 
 */
class Song extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => false,
        '*' => true
    ];

    /**
     * Hidden fields to not show in JSON responses
     *
     * @var array
     */
    protected $_hidden = [
        'id'
    ];
}
