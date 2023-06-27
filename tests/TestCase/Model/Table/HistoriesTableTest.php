<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\HistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistoriesTable Test Case
 */
class HistoriesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Histories',
        'app.Contacts',
        'app.Users',
        'app.Usergroups',
        'app.UsersUsergroups',
        'app.Units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Histories') ? [] : ['className' => 'App\Model\Table\HistoriesTable'];
        $this->Histories = TableRegistry::get('Histories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Histories);

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

    public function testFindOwnedBy()
    {
        $actual = $this->Histories->find('ownedBy', ['User.id' => 1])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [1, 2];
        $this->assertEquals($expected, $actual);

        $actual = $this->Histories->find('ownedBy', ['User.id' => [2, 3]])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [3, 4];
        $this->assertEquals($expected, $actual);
    }

    public function testFindAccessibleBy()
    {
        $actual = $this->Histories->find('accessibleBy', ['User.id' => 1])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [1, 2, 4];
        $this->assertEquals($expected, $actual);

        $actual = $this->Histories->find('accessibleBy', ['User.id' => 3])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [4];
        $this->assertEquals($expected, $actual);
    }
}
