<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsourcesTable Test Case
 */
class ContactsourcesTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Contactsources') ? [] : ['className' => 'App\Model\Table\ContactsourcesTable'];
		$this->Contactsources = TableRegistry::get('Contactsources', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contactsources);

		parent::tearDown();
	}

}
