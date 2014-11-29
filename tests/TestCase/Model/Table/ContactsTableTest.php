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
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.histories',
		'app.users',
		'app.events',
		'app.groups',
		'app.contacts_groups',
		'app.notifications',
		'app.contacts_users',
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
					 5 => [[
						'id' => 7,
						'name' => 'Dvaipayan pr',
						'contactname' => '',
						'lat' => 46.067917,
						'lng' => 18.222189
						]]];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnPhone(){
		$dupliactes = $this->Contacts->checkDuplicatesOnPhone();
		foreach($dupliactes as $actual){
			$actual = $actual->hydrate(false)->toArray();
			$expected = [
				['id' => 1, 'name' => 'Lokanatha dasa', 'contactname' => 'Borsos László', 'phone' => '+36 30 999 5091'],
				['id' => 2, 'name' => 'Acarya-ratna das', 'contactname' => '', 'phone' => '36/30 99-95-091'],
				['id' => 3, 'name' => 'Dvaipayana Dasa', 'contactname' => '', 'phone' => '06 (30) 99-95-091']
			];
			$this->assertEquals($expected, $actual);
		}
	}

	public function testCheckDuplicatesOnEmail(){
		$dupliactes = $this->Contacts->checkDuplicatesOnEmail();
		foreach($dupliactes as $dupliacte){
			$actual[] = $dupliacte->hydrate(false)->toArray();
		}
		$expected = [
			[
				['id' => 3, 'name' => 'Dvaipayana Dasa', 'contactname' => '', 'email' => 'dvd@1108.cc'],
				['id' => 4, 'name' => 'Acarya-ratna Dasa', 'contactname' => '', 'email' => 'dvd@1108.cc']
			],
			[
				['id' => 6, 'name' => 'Horváth Zoltán', 'contactname' => '', 'email' => 'senki@sehol.se'],
				['id' => 7, 'name' => 'Dvaipayan pr', 'contactname' => '', 'email' => 'senki@sehol.se']
			]
		];
		$this->assertEquals($expected, $actual);
	}

	public function testCheckDuplicatesOnBirth(){
		$dupliactes = $this->Contacts->checkDuplicatesOnBirth();
		foreach($dupliactes as $actual){
			$actual = $actual->hydrate(false)->toArray();
			$expected = [
				['id' => 1, 'name' => 'Lokanatha dasa', 'contactname' => 'Borsos László', 'birth' => Time::createFromFormat('Y-m-d H:i:s', '1974-09-12 00:00:00')],
				['id' => 6, 'name' => 'Horváth Zoltán', 'contactname' => null, 'birth' =>  Time::createFromFormat('Y-m-d H:i:s', '1974-09-12 00:00:00')]
			];
			$this->assertEquals($expected, $actual);
		}
	}

	public function testCheckDuplicatesOnNames(){
		$actual = $this->Contacts->checkDuplicatesOnNames();
		$expected = [
			2 => [
				[
					'id' => 4,
					'name' => 'Acarya-ratna Dasa',
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
	
	public function testFindMine(){
		$actual = $this->Contacts->find('mine', ['User.id' => 2])->hydrate(false)->toArray();
		$expected = [
				['id' => 2, 'name' => 'Acarya-ratna das', 'contactname' => '', 'address' => 'Rózsakert u. 6. II/9',
					'users' => [
						[
							'id' => (int) 2,
							'name' => 'user2',
							'password' => 'secretpass',
							'realname' => 'user2 real name',
							'email' => 'user2@sehol.se',
							'phone' => '+36123456789',
							'active' => true,
							'role' => 1,
							'created' => Time::createFromFormat('Y-m-d H:i:s', '2014-11-29 10:59:47'),
							'modified' => Time::createFromFormat('Y-m-d H:i:s', '2014-11-29 10:59:47'),
							'_joinData' => [
								'contact_id' => 2,
								'user_id' => 2
							]
						]
					],
					'groups' => [
								 ['id' => 1,'name' => 'NVD','description' => '',
								  'admin_user_id' => 1,'shared' => true,
								  '_joinData' => ['group_id' => 1, 'contact_id' => 2]
								 ]
								],
					'zip' => ['id' => 1, 'zip' => '1011', 'name' => 'Bp I.']
				]
			];
		$this->assertEquals($expected, $actual);
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
