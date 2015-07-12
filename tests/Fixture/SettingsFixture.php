<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SettingsFixture
 *
 */
class SettingsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'value' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_settings_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_settings_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'name' => 'Contacts/searchquery',
            'value' => 'qName=m%C3%A1rciusiak&condition_Contacts.contactname%5B%5D=%26%25&field_Contacts.contactname%5B%5D=&connect_Contacts.legalname=%26&condition_Contacts.legalname%5B%5D=%26%25&field_Contacts.legalname%5B%5D=&connect_Contacts.birth=%26&condition_Contacts.birth%5B%5D=%26%25&field_Contacts.birth%5B%5D=-03-'
        ],
        [
            'id' => 2,
            'user_id' => 1,
            'name' => 'Contacts/searchquery',
            'value' => 'qName=szeptemberi&condition_Contacts.contactname%5B%5D=%26%25&field_Contacts.contactname%5B%5D=&connect_Contacts.legalname=%26&condition_Contacts.legalname%5B%5D=%26%25&field_Contacts.legalname%5B%5D=&connect_Contacts.birth=%26&condition_Contacts.birth%5B%5D=%26%25&field_Contacts.birth%5B%5D=-09-'
        ],

        [
            'id' => 3,
            'user_id' => 1,
            'name' => 'default_groups',
            'value' => 'a:2:{i:0;i:6;i:1;i:7;}'
        ],

        [
            'id' => 4,
            'user_id' => 2,
            'name' => 'Contacts/index',
            'value' => 'a:6:{i:0;s:20:"Contacts.contactname";i:1;s:18:"Contacts.legalname";i:2;s:15:"Contacts.zip_id";i:3;s:14:"Contacts.phone";i:4;s:14:"Contacts.email";i:5;s:14:"Contacts.users";}'
        ],
    ];
}
