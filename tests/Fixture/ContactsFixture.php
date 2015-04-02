<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsFixture
 *
 */
class ContactsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'legalname' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'contactname' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'zip_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'address' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'lat' => ['type' => 'float', 'length' => 10, 'precision' => 6, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'lng' => ['type' => 'float', 'length' => 10, 'precision' => 6, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'phone' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'sex' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '1: male
2: female', 'precision' => null, 'autoIncrement' => null],
        'workplace' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'workplace_zip_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'workplace_address' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'workplace_phone' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'workplace_email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'family_id' => ['type' => 'string', 'fixed' => true, 'length' => 13, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'contactsource_id' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null],
        'comment' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'google_id' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_contacts_zips1_idx' => ['type' => 'index', 'columns' => ['zip_id'], 'length' => []],
            'fk_contacts_contactsources1_idx' => ['type' => 'index', 'columns' => ['contactsource_id'], 'length' => []],
            'families' => ['type' => 'index', 'columns' => ['family_id'], 'length' => []],
            'fk_contacts_zips2_idx' => ['type' => 'index', 'columns' => ['workplace_zip_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_contacts_zips2' => ['type' => 'foreign', 'columns' => ['workplace_zip_id'], 'references' => ['zips', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_contacts_contactsources1' => ['type' => 'foreign', 'columns' => ['contactsource_id'], 'references' => ['contactsources', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_contacts_zips1' => ['type' => 'foreign', 'columns' => ['zip_id'], 'references' => ['zips', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
	public $records = [
		['id' => 1,'legalname' => 'Lokanatha dasa','contactname' => 'Borsos László','zip_id' => '103',
			'address' => 'Petneházy u. 14.','lat' => '47.534565','lng' => '19.072510',
			'phone' => '+36 30 999 5091','email' => 'borsosl@gmail.com',
			'birth' => '1974-09-12','sex' => '1','workplace' => 'MSCI Barra',
			'family_id' => '1','contactsource_id' => '2','active' => '1',
			'comment' => '','created' => '2014-10-06 18:23:19','modified' => '2014-10-28 11:46:36'],
		['id' => 2,'legalname' => 'Acarya-ratna das','contactname' => '','zip_id' => '1',
			'address' => 'Rózsakert u. 6. II/9','lat' => '47.660961','lng' => '19.077259',
			'phone' => '36/30 99-95-091','email' => 'halterand@gmail.com',
			'birth' => NULL,'sex' => '0','workplace' => '',
			'family_id' => NULL,'contactsource_id' => '4','active' => '1',
			'comment' => 'kis eü probléma','created' => NULL,'modified' => '2014-10-25 08:09:44'],
		['id' => 3,'legalname' => 'Dvaipayana Dasa','contactname' => '','zip_id' => '3287',
			'address' => 'Nitáj krt 26','lat' => '46.567085','lng' => '17.701822',
			'phone' => '06 (30) 99-95-091','email' => 'dvd@1108.cc',
			'birth' => NULL,'sex' => '1','workplace' => '',
			'family_id' => NULL,'contactsource_id' => '4','active' => '1',
			'comment' => 'rendszeresen fizet','created' => NULL,'modified' => '2014-11-09 14:34:42'],
		['id' => 4,'legalname' => 'Acarya-ratna Dasa','contactname' => '','zip_id' => '162',
			'address' => 'Rózsakert utca 6','lat' => '0.000000','lng' => '0.000000',
			'phone' => '06 20 56 58 774','email' => 'dvd@1108.cc',
			'birth' => NULL,'sex' => NULL,'workplace' => '',
			'family_id' => NULL,'contactsource_id' => '4','active' => '1',
			'comment' => 'adategyeztetés !','created' => NULL,'modified' => '2014-11-09 12:31:27'],
		['id' => 5,'legalname' => 'Filu','contactname' => 'Filutás István','zip_id' => '2603',
			'address' => 'Temesvári utca 6.','lat' => '46.067909','lng' => '18.222189',
			'phone' => '06-30-221-6998','email' => 'filutas.istvan@t-online.hu',
			'birth' => NULL,'sex' => NULL,'workplace' => 'Kórház',
			'family_id' => NULL,'contactsource_id' => '4','active' => '1',
			'comment' => 'külföldön dolgoznak','created' => NULL,'modified' => '2014-11-09 12:28:57'],
		['id' => 6,'legalname' => 'Horváth Zoltán','contactname' => NULL,'zip_id' => '924',
			'address' => 'Kis Hunyad 39. mfsz 1','lat' => '0.000000','lng' => '0.000000',
			'phone' => '06-30-587-0741','email' => 'senki@sehol.se',
			'birth' => '1974-09-12','sex' => NULL,'workplace' => NULL,
			'family_id' => NULL,'contactsource_id' => '4','active' => '1',
			'comment' => '2012ben fizetett utoljára','created' => NULL,'modified' => NULL],
		['id' => 7,'legalname' => 'Dvaipayan pr','contactname' => '','zip_id' => NULL,
			'address' => '','lat' => '46.067915','lng' => '18.222189',
			'phone' => '85/540-002','email' => 'senki@sehol.se',
			'birth' => NULL,'sex' => '1','workplace' => '',
			'family_id' => NULL,'contactsource_id' => '2','active' => '1',
			'comment' => '','created' => '2014-11-09 14:44:38','modified' => '2014-11-09 14:44:39']
	  ];
}
