<?php
use Migrations\AbstractMigration;

class CreateDateCategoriesTable extends AbstractMigration
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
        $table = $this->table('date_categories');
        $table->addColumn('category', 'string', [
            'limit' => 255,
            'default' => null,
            'null' => false
        ]);
        $table->create();
    }
}
