<?php

use Phinx\Seed\AbstractSeed;

class DateCategoriesSeeder extends AbstractSeed
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
        # https://igdb.github.io/api/enum-fields/date-category/ 2018-08-14

        $data = [
            [
                'category' => 'YYYY MMM DD',
            ],
            [
                'category' => 'YYYY-MMM',
            ],
            [
                'category' => 'YYYY',
            ],
            [
                'category' => 'YYYY-Q1',
            ],
            [
                'category' => 'YYYY-Q2',
            ],
            [
                'category' => 'YYYY-Q3',
            ],
            [
                'category' => 'YYYY-Q4',
            ],
            [
                'category' => 'TBD'
            ]
        ];

        $website_categories = $this->table('date_categories');
        $website_categories->insert($data)
                           ->save();
    }
}
