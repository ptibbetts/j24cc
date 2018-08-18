<?php
use Migrations\AbstractMigration;

class CreateCompaniesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('companies');

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
           ])->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
          ])->addColumn('url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
          ])->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
          ])->addColumn('website', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
          ])->addColumn('start_date', 'time', [
            'default' => null,
            'null' => false,
          ])->addColumn('start_date_category', 'integer', [
            'default' => null,
            'null' => false
          ])->addColumn('twitter', 'string', [
            'limit' => 255,
            'default' => null,
            'null' => true
          ])->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
          ])->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
          ]);

        $table->create();
    }
}
