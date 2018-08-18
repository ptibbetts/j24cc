<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Website Entity
 *
 * @property int $id
 * @property int $game_id
 * @property string $url
 *
 * @property \App\Model\Entity\Game $game
 */
class Website extends Entity
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
        'game_id' => true,
        'url' => true,
        'game' => true
    ];
}
