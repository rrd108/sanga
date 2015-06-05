<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsTable;
use Cake\TestSuite\TestCase;
use Cake\I18n\Time;

/**
 * App\Model\Table\ContactsTable Test Case
 */
class ContactsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'Contacts' => 'app.contacts',
        'Zips' => 'app.zips',
        'Countries' => 'app.countries',
        'WorkplaceZips' => 'app.zips',
        'Contactsources' => 'app.contactsources',
        'Histories' => 'app.histories',
        'Users' => 'app.users',
        'Events' => 'app.events',
        'AdminGroups' => 'app.groups',
        'AdminUsers' => 'app.users',
        'Notifications' => 'app.notifications',
        'ContactsUsers' => 'app.contacts_users',
        'Groups' => 'app.groups',
        'ContactsGroups' => 'app.contacts_groups',
        'groups_users' => 'app.groups_users',
        'Usergroups' => 'app.usergroups',
        'UsersUsergroups' => 'app.users_usergroups',
        'Units' => 'app.units',
        'Skills' => 'app.skills',
        'ContactsSkills' => 'app.contacts_skills'
    ];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Contacts') ? [] : ['className' => 'App\Model\Table\ContactsTable'];
		$this->Contacts = TableRegistry::get('Contacts', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contacts);

		parent::tearDown();
	}

	public function testCheckDuplicatesOnGeo(){
		$actual = $this->Contacts->checkDuplicatesOnGeo();
		$expected = [
			[
			'id1' => (int) 5,
			'id2' => (int) 7,
			'field' => 'geo',
			'data' => '3 & Temesvári utca 6. : 3 & Temesvári utca 5.'
			]
		];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnPhone(){
		$actual = $this->Contacts->checkDuplicatesOnPhone();
		$expected = [
				['id1' => 1, 'id2' => 2, 'data' => '+36 30 999 5091', 'field' => 'phone'],
				['id1' => 1, 'id2' => 3, 'data' => '+36 30 999 5091', 'field' => 'phone'],
				['id1' => 2, 'id2' => 3, 'data' => '36/30 99-95-091', 'field' => 'phone']
			];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnEmail(){
		$actual = $this->Contacts->checkDuplicatesOnEmail();
		$expected = [
				['id1' => 3, 'id2' => 4, 'data' => 'dvd@1108.cc', 'field' => 'email'],
				['id1' => 6, 'id2' => 7, 'data' => 'senki@sehol.se', 'field' => 'email']
			];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnBirth(){
		$actual = $this->Contacts->checkDuplicatesOnBirth();
		$expected = [
				['id1' => 1, 'id2' => 6, 'data' => Time::createFromFormat('Y-m-d H:i:s', '1974-09-12 00:00:00'), 'field' => 'birth']
			];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnNames(){
		$actual = $this->Contacts->checkDuplicatesOnNames();
		$expected = [
			2 => [
				[
					'id' => 4,
					'legalname' => 'Acarya-ratna Dasa',
					'contactname' => '',
					'levenshteinNameName' => '1',
					'levenshteinContactnameName' => '16',
					'levenshteinNameContactname' => null,
					'levenshteinContactnameContactname' => null
				]
			]
		];
		$this->assertEquals($expected, $actual);
	}
	
	public function testFindOwnedBy(){
		$_actual = $this->Contacts->find('ownedBy', ['User.id' => 2])->hydrate(false)->toArray();
		//debug($actual);
		foreach($_actual as $a) {
			$actual[] = ['id' => $a['id'], 'legalname' => $a['legalname']];
		}
		$expected = [
				['id' => 2, 'legalname' => 'Acarya-ratna das'],
				['id' => 3, 'legalname' => 'Dvaipayana Dasa'],
				['id' => 4, 'legalname' => 'Acarya-ratna Dasa'],
				['id' => 5, 'legalname' => 'Filu']
			];
		$this->assertEquals($expected, $actual);
	}
	
	public function testIsAccessibleAsContactPerson(){
		//testing private method
		$class = new \ReflectionClass($this->Contacts);
		$method = $class->getMethod('isAccessibleAsContactPerson');
		$method->setAccessible(true);
		
		$actual = $method->invoke($this->Contacts, 6, 3);
		$this->assertTrue($actual);

		$actual = $method->invoke($this->Contacts, 6, 1);
		$this->assertFalse($actual);
	}

	public function testIsAccessibleAsGroupMember(){
		//testing private method
		$class = new \ReflectionClass($this->Contacts);
		$method = $class->getMethod('isAccessibleAsGroupMember');
		$method->setAccessible(true);
		
		$actual = $method->invoke($this->Contacts, 6, 2);
		$this->assertTrue($actual);

		$actual = $method->invoke($this->Contacts, 7,2);
		$this->assertFalse($actual);
	}

	public function testIsAccessibleAsUsergroupMember(){
		//testing private method
		$class = new \ReflectionClass($this->Contacts);
		$method = $class->getMethod('isAccessibleAsUsergroupMember');
		$method->setAccessible(true);

		$actual = $method->invoke($this->Contacts, 6, 1);
		$this->assertTrue($actual);

		$actual = $method->invoke($this->Contacts, 6, 2);
		$this->assertFalse($actual);
	}
	
	public function testIsAccessible(){
		$actual = $this->Contacts->isAccessible(1, 1);
		$this->assertTrue($actual);

		$actual = $this->Contacts->isAccessible(1, 2);
		$this->assertFalse($actual);

		//as a group member or group admin
		$actual = $this->Contacts->isAccessible(6, 2);
		$this->assertTrue($actual);

		$actual = $this->Contacts->isAccessible(7, 2);
		$this->assertFalse($actual);

		//as a usergroup member
		$actual = $this->Contacts->isAccessible(6, 1);
		$this->assertTrue($actual);
		
		//admin user
		$actual = $this->Contacts->isAccessible(6, 4);
		$this->assertTrue($actual);
	}
	
	public function testHasAccess() {
		$actual = $this->filterHasAccess($this->Contacts->hasAccess(3));		
		$expected = ['contactPersons' => [2],
					'groupMembers' => [],
					'usergroupMembers' => []];
		$this->assertEquals($expected, $actual);
		
		$actual = $this->filterHasAccess($this->Contacts->hasAccess(5));		
		$expected = ['contactPersons' => [2, 3],
					'groupMembers' => [],
					'usergroupMembers' => [1, 3]];
		$this->assertEquals($expected, $actual);

		$actual = $this->filterHasAccess($this->Contacts->hasAccess(2));
		//debug($actual);
		$expected = ['contactPersons' => [2],
					'groupMembers' => [1],
					'usergroupMembers' => []];
		$this->assertEquals($expected, $actual);
		
		$actual = $this->filterHasAccess($this->Contacts->hasAccess(6));
		$expected = ['contactPersons' => [3],
					'groupMembers' => [2],
					'usergroupMembers' => [1, 3]];
		$this->assertEquals($expected, $actual);
	}
	
	private function filterHasAccess($actual){
		foreach($actual as $type => $a) {
			foreach ($a as $i => $user) {
				$actual[$type][$i] = $user->id;
			}
		}
		//debug($actual);
		return $actual;
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test beforeSave method
 *
 * @return void
 */
	public function testBeforeSave() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test afterSave method
 *
 * @return void
 */
	public function testAfterSave() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
