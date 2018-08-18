<?php
use Migrations\AbstractMigration;

class CreateWebsitesTable extends AbstractMigration
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
        $table = $this->table('websites');

        $table->addColumn('game_id', 'integer', [
              'default' => null,
              'length' => 11,
              'null' => false,
            ])->addColumn('url', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => false,
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
