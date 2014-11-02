<?php
namespace RBruteForce\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RbruteforcesFixture
 *
 */
class RbruteforcesFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'ip' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'url' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'expire' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
		'_indexes' => [
			'ip' => ['type' => 'index', 'columns' => ['ip'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['expire'], 'length' => []],
		],
		'_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
		],
	];

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'ip' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'expire' => 1414908381
		],
	];

}
