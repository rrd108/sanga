<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsSkillsFixture
 *
 */
class ContactsSkillsFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'contact_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'skill_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'_indexes' => [
			'fk_contacts_has_experties_experties1_idx' => ['type' => 'index', 'columns' => ['skill_id'], 'length' => []],
			'fk_contacts_has_experties_contacts1_idx' => ['type' => 'index', 'columns' => ['contact_id'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['contact_id', 'skill_id'], 'length' => []],
			'fk_contacts_has_experties_contacts1' => ['type' => 'foreign', 'columns' => ['contact_id'], 'references' => ['contacts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
			'fk_contacts_has_experties_experties1' => ['type' => 'foreign', 'columns' => ['skill_id'], 'references' => ['skills', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
			'contact_id' => 1,
			'skill_id' => 1
		],
	];

}
