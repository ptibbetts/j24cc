<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

?>

    <main class="bd-masthead container-fluid" id="content" role="main">

        <div id="results" class="row"></div>

    </main>

<div class="masthead-followup m-0 row border border-white">
  <div class="col-12 col-md-4 p-3 p-md-5 bg-light border border-white">
    <!-- Icon by Bytesize https://github.com/danklammer/bytesize-icons -->
    <svg id="i-import" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
        <path d="M28 22 L28 30 4 30 4 22 M16 4 L16 24 M8 16 L16 24 24 16" />
    </svg>

    <h3>IGDB API</h3>
    <p>✅ Retrieve a set of resources from the API on first load</p>
    <p>✅ Save a reasonable set of API information to a MySQL database</p>
    <p>✅ Aim to store 500+ records (duplicates with a method of distinguishing between records is acceptable if an API is rate limited) into multiple tables</p>

    <hr class="half-rule">
    <a class="btn btn-outline-primary" href="#">View Source</a>
  </div>

  <div class="col-12 col-md-4 p-3 p-md-5 bg-light border border-white">
    <!-- Icon by Bytesize https://github.com/danklammer/bytesize-icons -->
    <svg id="i-compose" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
        <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" />
    </svg>

    <h3>SQL Statement</h3>
    <p>✅ Build a SQL statement that iterates over each record, modifies it, and stores it to a new table</p>

    <hr class="half-rule">
    <a class="btn btn-outline-primary" href="">View Source</a>
  </div>

  <div class="col-12 col-md-4 p-3 p-md-5 bg-light border border-white">
    <!-- Icon by Bytesize https://github.com/danklammer/bytesize-icons -->
    <svg id="i-code" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
        <path d="M10 9 L3 17 10 25 M22 9 L29 17 22 25 M18 7 L14 27" />
    </svg>

    <h3>Bootstrap + JS</h3>
    <p>✅ Display the modified data within a Bootstrap interface, that makes use of at least one piece of custom JavaScript developed by you</p>

    <hr class="half-rule">
    <a href="#" class="btn btn-outline-primary">View Source</a>
  </div>
</div>

<script>
let games = <?= json_encode($games); ?>;
const displayedGames = [];

let page = 0;
const perPage = 10;

const results = document.getElementById('results');

const displayGames = () => {
  const start = page * perPage;
  const end = start + perPage - 1;
  for (let i = start; i <= end; i++) {
    if (games[i]) {
      displayedGames.push(games[i]);
    }
  }
  const html = displayedGames.map((game, index) => {
      let rating = '';
      let size = 'col-md-2';
      if (game["rating"]) {
        if (game["rating"] == '100') {
            rating = `<span role="img" aria-label="100%" style="font-size:2rem;color:red">💯</span>`
            size = 'col-md-4';
        } else {
            rating = `${game["rating"]}%`;
        }
      }
    return `
    <div class="${size}">
        <a href="/games/view/${game["id"]}" class="card mb-4">
            <img class="card-img-top" src="//images.igdb.com/igdb/image/upload/t_cover_big/${game["cover"]}.jpg" alt="${game["name"]} cover image">
            <div class="card-body text-dark">
                <p class="card-title" style="max-width:100%;overflow:hidden;height:2rem;white-space:nowrap;text-overflow:ellipsis">
                    ${index + 1}. ${game["name"]}
                </p>
                <p class="card-text">
                    ${rating}
                </p>
            </div>
        </a>
    </div>
  `
  }).join('');
  results.innerHTML = html;
}

const displayMoreGames = () => {
  if (displayedGames.length === games.length) return;
  page++;
  displayGames();
}

window.onscroll = () => {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - (document.body.offsetHeight / 5)) {
    displayMoreGames();
  }
};

displayGames();
</script>
