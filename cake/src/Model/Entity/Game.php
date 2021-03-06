<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Game Entity
 *
 * @property int $id
 * @property int $igdb_id
 * @property string $name
 * @property string $slug
 * @property string $summary
 * @property float $rating
 * @property float $popularity
 * @property string $cover
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Website[] $websites
 */
class Game extends Entity
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
        'igdb_id' => true,
        'name' => true,
        'slug' => true,
        'summary' => true,
        'rating' => true,
        'popularity' => true,
        'cover' => true,
        'created' => true,
        'modified' => true,
        'websites' => true
    ];
}
