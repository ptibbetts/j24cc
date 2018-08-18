<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Top500UpdateTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Top500UpdateTable Test Case
 */
class Top500UpdateTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Top500UpdateTable
     */
    public $Top500Update;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.top500_update'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Top500Update') ? [] : ['className' => Top500UpdateTable::class];
        $this->Top500Update = TableRegistry::getTableLocator()->get('Top500Update', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Top500Update);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
