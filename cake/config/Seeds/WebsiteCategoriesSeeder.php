<?php

use Phinx\Seed\AbstractSeed;

class WebsiteCategoriesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        # https://igdb.github.io/api/enum-fields/website-category/ 2018-08-14

        $data = [
            [
                'category' => 'official',
            ],
            [
                'category'    => 'wikia',
            ],
            [
                'category' => 'wikipedia',
            ],
            [
                'category' => 'facebook',
            ],
            [
                'category' => 'twitter',
            ],
            [
                'category' => 'twitch',
            ],
            [
                'category' => 'instagram',
            ],
            [
                'category' => 'youtube',
            ],
            [
                'category' => 'iphone',
            ],
            [
                'category' => 'ipad',
            ],
            [
                'category' => 'android',
            ],
            [
                'category' => 'steam',
            ],
            [
                'category' => 'Reddit',
            ],
        ];

        $website_categories = $this->table('website_categories');
        $website_categories->insert($data)
                           ->save();
    }
}
