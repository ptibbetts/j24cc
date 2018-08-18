<?php
use Migrations\AbstractMigration;

class CreateWebsiteCategoriesTable extends AbstractMigration
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
        $table = $this->table('website_categories');

        $table->addColumn('category', 'string', [
            'default' => null,
            'null' => false,
            'length' => 255
        ]);

        $table->create();
    }
}
