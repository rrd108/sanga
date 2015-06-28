<?php
namespace App\Test\TestCase\Controller;

use App\Controller\HistoriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\HistoriesController Test Case
 */
class HistoriesControllerTest extends IntegrationTestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        
        'app.contactsources',
        'app.groups',
        
        'app.contacts_groups',
        'app.users',
        'app.events',
        'app.notifications',
        'app.contacts_users',
        'app.groups_users',
        
        'app.usergroups',
        'app.users_usergroups',
        'app.skills',
        'app.contacts_skills',
        'app.units'
    ];

/**
 * Test index method
 *
 * @return void
 */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test view method
 *
 * @return void
 */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test add method
 *
 * @return void
 */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test edit method
 *
 * @return void
 */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test delete method
 *
 * @return void
 */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
