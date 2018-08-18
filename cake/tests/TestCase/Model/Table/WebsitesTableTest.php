<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WebsitesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WebsitesTable Test Case
 */
class WebsitesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WebsitesTable
     */
    public $Websites;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.websites',
        'app.games'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Websites') ? [] : ['className' => WebsitesTable::class];
        $this->Websites = TableRegistry::getTableLocator()->get('Websites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Websites);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
