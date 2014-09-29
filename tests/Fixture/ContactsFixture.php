<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsFixture
 *
 */
class ContactsFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
		'name' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'contactname' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'country_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'zip_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'address' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'phone' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'active' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null],
		'comment' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'contactsource_id' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'_indexes' => [
			'fk_contacts_zips1_idx' => ['type' => 'index', 'columns' => ['zip_id'], 'length' => []],
			'fk_contacts_countries1_idx' => ['type' => 'index', 'columns' => ['country_id'], 'length' => []],
			'fk_contacts_contactsources1_idx' => ['type' => 'index', 'columns' => ['contactsource_id'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id', 'contactsource_id'], 'length' => []],
			'fk_contacts_zips1' => ['type' => 'foreign', 'columns' => ['zip_id'], 'references' => ['zips', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
			'fk_contacts_countries1' => ['type' => 'foreign', 'columns' => ['country_id'], 'references' => ['countries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
			'fk_contacts_contactsources1' => ['type' => 'foreign', 'columns' => ['contactsource_id'], 'references' => ['contactsources', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
		],
		'_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_hungarian_ci'
		],
	];

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'contactname' => 'Lorem ipsum dolor sit amet',
			'country_id' => 1,
			'zip_id' => 1,
			'address' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'birth' => '2014-09-27',
			'active' => 1,
			'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2014-09-27 09:29:59',
			'modified' => '2014-09-27 09:29:59',
			'contactsource_id' => 1
		],
	];

}
