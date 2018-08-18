<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function home()
    {
        $this->loadComponent('IGDB');

        $connection = ConnectionManager::get('default');

        if (! $this->IGDB->lastUpdated() ||
            ! $this->IGDB->lastUpdated()->wasWithinLast('24 hours')) {

            // Pull from IGDB
            $this->IGDB->update();

            // Run the SQL commands
            $create_new_table = 'CREATE TABLE IF NOT EXISTS games_updated LIKE games';
            $connection->execute($create_new_table);

            $loop_and_modify  = "";
            $loop_and_modify .= "INSERT INTO games_updated (id, igdb_id, name, slug, summary, rating, popularity, cover, created, modified)\n";
            $loop_and_modify .= "SELECT g.id, g.igdb_id, g.name, g.slug, g.summary, g.rating, g.popularity, g.cover, g.created, NOW()\n";
            $loop_and_modify .= "FROM games g \n";
            $loop_and_modify .= "ON DUPLICATE KEY UPDATE id=g.id, igdb_id=g.igdb_id, name=g.name, slug=g.slug, summary=g.summary, rating=g.rating, popularity=g.popularity, cover=g.cover";
            $connection->execute($loop_and_modify);

            $games = [
                'Half-Life 2',
                'Batman: Arkham City',
                'Titanfall 2',
                'Portal 2',
                'Counter-Strike: Global Offensive'
            ];

            $fix_ratings = "UPDATE games_updated SET rating = '100' WHERE NAME IN ('".implode('\',\'', $games)."') AND ID IS NOT NULL";
            $connection->execute($fix_ratings);

            $this->IGDB->updated();
        }

        $games = $connection
            ->newQuery()
            ->select('*')
            ->from('games_updated')
            ->execute()
            ->fetchAll('assoc');

        $this->set(compact('games'));
    }
}
