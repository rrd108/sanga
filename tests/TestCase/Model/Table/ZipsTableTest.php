<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ZipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZipsTable Test Case
 */
class ZipsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Zips' => 'app.zips',
        'Countries' => 'app.countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Zips') ? [] : ['className' => 'App\Model\Table\ZipsTable'];
        $this->Zips = TableRegistry::get('Zips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Zips);

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
	
	public function testGetIdForZip()
	{
		$actual = $this->Zips->getIdForZip(1012);		
		$expected = 2;
		$this->assertEquals($expected, $actual);

		$actual = $this->Zips->getIdForZip('notexists');		
		$expected = null;
		$this->assertEquals($expected, $actual);
	}
}
