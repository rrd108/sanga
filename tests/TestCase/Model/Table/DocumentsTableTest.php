<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentsTable Test Case
 */
class DocumentsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.documents',
        'app.contacts',
        'app.zips',
        'app.countries',
        'app.workplace_zips',
        'app.contactsources',
        'app.histories',
        'app.users',
        'app.events',
        'app.admin_groups',
        'app.admin_users',
        'app.notifications',
        'app.senders',
        'app.settings',
        'app.contacts_users',
        'app.groups',
        'app.contacts_groups',
        'app.groups_users',
        'app.usergroups',
        'app.users_usergroups',
        'app.units',
        'app.skills',
        'app.contacts_skills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Documents') ? [] : ['className' => 'App\Model\Table\DocumentsTable'];
        $this->Documents = TableRegistry::get('Documents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Documents);

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
