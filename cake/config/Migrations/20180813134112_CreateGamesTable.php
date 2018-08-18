<?php
use Migrations\AbstractMigration;

class CreateGamesTable extends AbstractMigration
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
        $table = $this->table('games');

        $table->addColumn('igdb_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ])->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])->addColumn('summary', 'text', [
            'default' => null,
            'null' => true,
            'encoding' => 'utf8mb4'
        ])->addColumn('rating', 'decimal', [
            'default' => null,
            'null' => true,
        ])->addColumn('popularity', 'decimal', [
            'default' => null,
            'null' => true,
        ])->addColumn('cover', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true
        ])->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])->addIndex(['igdb_id'], ['unique' => true])
          ->addIndex(['slug'], ['unique' => true]);

        $table->create();
    }
}
