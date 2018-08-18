<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Cake\ORM\TableRegistry;

use App\IGDB;
use Cake\I18n\Time;

/**
 * IGDB component
 */
class IGDBComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Updates the Top $amount Games from IGDB
     *
     * @param integer $amount
     * @return void
     */
    public function update($amount = 501)
    {
        $IGDB = new IGDB('d145c5ff33c0074ba46722ea87c43a8f');

        $games = [];

        $limit = min($amount, 50);
        $pages = ceil($amount / $limit);
        $order = 'popularity:desc';

        $fields = [
            'id',
            'name',
            'slug',
            'summary',
            'rating',
            'popularity',
            'cover',
            'websites'
        ];

        for ($i = 0; $i < $pages; $i++) {
            $offset = $i * $limit;

            $options = array(
            'search' => '',
            'fields' => $fields,
            'limit' => $limit,
            'offset' => $offset,
            'order' => $order
        );
            try {
                $data = $IGDB->game($options);
                $games = array_merge($data, $games);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        foreach ($games as $game) {
            $this->saveGame($game);
        }
    }

    /**
     * Saves a Game from IGDB data
     *
     * @param \App\IGDB\Game
     * @return void
     */
    public function saveGame($game)
    {
        $games_collection = TableRegistry::get('Games');

        $conditions = [
            'slug' => $game->slug
        ];

        if (!$games_collection->find('all')->where($conditions)->first()) {
            $websites = [];

            if (isset($game->websites)) {
                foreach ($game->websites as $website) {
                    $ws = $games_collection->Websites->newEntity([
                        'url' => $website->url
                    ]);

                    array_push($websites, $ws);
                }
            }

            $entity = $games_collection->newEntity([
                'igdb_id' => $game->id,
                'name' => $game->name,
                'popularity' => $game->popularity,
                'slug' => $game->slug,
                'summary' => isset($game->summary) ? mb_convert_encoding($game->summary, "UTF8") : null,
                'rating' => isset($game->rating) ? $game->rating : null,
                'cover' => isset($game->cover) && isset($game->cover->url) ? $game->cover->cloudinary_id : null,
            ]);

            $games_collection->save($entity);

            if ($websites) {
                $entity->websites = $websites;
                $games_collection->save($entity);
            }
        }
    }

    /**
     * Returns the date the Top 500 Games were last updated
     *
     *
     * @return \Cake\I18n\Date
     */
    public function lastUpdated()
    {
        $updates = TableRegistry::get('Top500Updates')->find();

        if (! iterator_count($updates)) {
            return false;
        }

        return $updates->first()->modified;
    }

    /**
     * Records that the Top 500 Games were updated
     *
     * @return void
     */
    public function updated()
    {
        $updates = TableRegistry::get('Top500Updates');
        $update = $updates->newEntity();
        $update->modified = Time::now();

        return $updates->save($update);
    }

    /**
     * Updates a single Game
     *
     * @param [type] $id
     * @return void
     */
    public function fetch($id)
    {
        // use class to get single and store
    }
}
