<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ContactsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsController Test Case
 */
class ContactsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contacts',
        'app.zips',
        'app.countries',
        'app.contactsources',
        'app.histories',
        'app.users',
        'app.events',
        'app.notifications',
        'app.settings',
        'app.contacts_users',
        'app.groups',
        'app.contacts_groups',
        'app.groups_users',
        'app.usergroups',
        'app.users_usergroups',
        'app.units',
        'app.documents',
        'app.skills',
        'app.contacts_skills'
    ];

    public function testAddUnauthenticatedFails()
    {
        $this->get('/contacts/add');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    private function authenticate(){
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'name' => 'admin',
                ]
            ]
        ]);
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    /*public function testIsAuthorized()
    {
        $this->assertResponseOk();
    }*/

    /**
     * Test showmap method
     *
     * @return void
     */
    public function testShowmap()
    {
        $this->authenticate();
        $this->get('contacts/showmap');
        $this->assertResponseOk();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->authenticate();
        $this->get('contacts');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->authenticate();
        $this->get('contacts/view/1');
        $this->assertResponseOk();
    }
}
