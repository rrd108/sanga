<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\NotificationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationsTable Test Case
 */
class NotificationsTableTest extends TestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.notifications',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        'app.contactsources',
        'app.groups',
        'app.contacts_groups',
        'app.contacts_users',
        'app.skills',
        'app.contacts_skills',
        'app.units',
        'app.usergroups',
        'app.users_usergroups'
    ];

/**
 * setUp method
 *
 * @return void
 */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Notifications') ? [] : ['className' => 'App\Model\Table\NotificationsTable'];
        $this->Notifications = TableRegistry::get('Notifications', $config);
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown()
    {
        unset($this->Notifications);

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
 * Test findUnread method
 *
 * @return void
 */
    public function testFindUnread()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
