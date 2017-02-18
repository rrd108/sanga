<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsTable;
use Cake\TestSuite\TestCase;
use Cake\I18n\Time;
use Cake\Utility\Hash;
use Cake\Collection\Collection;

/**
 * App\Model\Table\ContactsTable Test Case
 */
class ContactsTableTest extends TestCase
{

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
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contacts') ? [] : ['className' => 'App\Model\Table\ContactsTable'];
        $this->Contacts = TableRegistry::get('Contacts', $config);
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown()
    {
        unset($this->Contacts);
        parent::tearDown();
    }

    public function testCheckDuplicatesFull()
    {
        $actual = $this->Contacts->checkDuplicates();
        $actual = Hash::format($actual, ['{n}.id1', '{n}.id2'], '%1$d, %2$d');
        $expected = ['3, 4', '6, 7', '1, 6', '1, 2', '1, 3', '2, 3', '5, 7', '1, 7'];
        $this->assertEquals($expected, $actual);

        $actual = Hash::format($this->Contacts->checkDuplicates(3), ['{n}.id1', '{n}.id2'], '%1$d, %2$d');
        $expected = ['6, 7', '5, 7'];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckDuplicatesOnEmail()
    {
        $actual = $this->Contacts->checkDuplicatesOnEmail();
        $expected = [
            ['id1' => 3, 'id2' => 4, 'data' => 'dvd@1108.cc', 'field' => 'email'],
            ['id1' => 6, 'id2' => 7, 'data' => 'senki@sehol.se', 'field' => 'email']
        ];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts->checkDuplicatesOnEmail(3);
        $expected = [
            ['id1' => 6, 'id2' => 7, 'data' => 'senki@sehol.se', 'field' => 'email']
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckDuplicatesOnBirth()
    {
        $actual = $this->Contacts->checkDuplicatesOnBirth();
        $expected = [
            [
                'id1' => 1,
                'id2' => 6,
                'data' => Time::createFromFormat('Y-m-d H:i:s', '1974-09-12 00:00:00'),
                'field' => 'birth'
            ],
            [
                'id1' => 3,
                'id2' => 4,
                'data' => Time::createFromFormat('Y-m-d H:i:s', '1985-08-05 00:00:00'),
                'field' => 'birth'
            ]
        ];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts->checkDuplicatesOnBirth(2);
        $expected = [
            [
                'id1' => 3,
                'id2' => 4,
                'data' => Time::createFromFormat('Y-m-d H:i:s', '1985-08-05 00:00:00'),
                'field' => 'birth'
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckDuplicatesOnPhone()
    {
        $actual = $this->Contacts->checkDuplicatesOnPhone();
        $expected = [
            ['id1' => 1, 'id2' => 2, 'data' => '+36 30 999 5091', 'field' => 'phone'],
            ['id1' => 1, 'id2' => 3, 'data' => '+36 30 999 5091', 'field' => 'phone'],
            ['id1' => 2, 'id2' => 3, 'data' => '36/30 99-95-091', 'field' => 'phone']
        ];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts->checkDuplicatesOnPhone(2);
        $expected = [
            ['id1' => 2, 'id2' => 3, 'data' => '36/30 99-95-091', 'field' => 'phone']
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckDuplicatesOnGeo()
    {
        $actual = $this->Contacts->checkDuplicatesOnGeo();
        $expected = [
            [
            'id1' => 3,
            'id2' => 4,
            'field' => 'geo',
            'data' => '3287 & Nitáj krt 26 : 3287 & Nitáj krt 25'
            ],
            [
            'id1' => 5,
            'id2' => 7,
            'field' => 'geo',
            'data' => '3 & Temesvári utca 6. : 3 & Temesvári utca 5.'
            ]
        ];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts->checkDuplicatesOnGeo(3);
        $expected = [
            [
                'id1' => 5,
                'id2' => 7,
                'field' => 'geo',
                'data' => '3 & Temesvári utca 6. : 3 & Temesvári utca 5.'
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckDuplicatesOnNames()
    {
        $actual = $this->Contacts->checkDuplicatesOnNames();
        $expected = [
            [
                'id1' => 1,
                'id2' => 7,
                'field' => 'name',
                'data' => 'Lokanatha dasa & Borsos László : Borsos László & Dvaipayan pr',
                'levenshtein' => [
                   'lcc' => 13,
                   'lcl' => 12,
                   'llc' => 0,
                   'lll' => 13
                ]
            ]
        ];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts->checkDuplicatesOnNames(3);
        $expected = [];
        $this->assertEquals($expected, $actual);
    }

    public function testFindOwnedBy()
    {
        $actual = $this->Contacts->find('ownedBy', ['User.id' => 2])
        ->hydrate(false)
        ->extract('id')
        ->toArray();
        $expected = [2, 3, 4, 5];
        $this->assertEquals($expected, $actual);
    }

    public function testFindAccessibleViaGroupBy()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('findAccessibleViaGroupBy');
        $method->setAccessible(true);

        $actual = $method->invoke(
            $this->Contacts,
            $this->Contacts->find(),
            ['User.id' => 2]
        )->hydrate(false)->extract('id')->toArray();
        $expected = [1, 2, 6];
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke(
            $this->Contacts,
            $this->Contacts->find(),
            ['User.id' => 1]
        )->hydrate(false)->extract('id')->toArray();
        $expected = [1, 2];
        $this->assertEquals($expected, $actual);
    }

    public function testFindAccessibleViaUsergroupBy()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('findAccessibleViaUsergroupBy');
        $method->setAccessible(true);

        $actual = $method->invoke(
            $this->Contacts,
            $this->Contacts->find(),
            ['User.id' => 1]
        )->hydrate(false)->extract('id')->toArray();
        $expected = [5, 6, 7];
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke(
            $this->Contacts,
            $this->Contacts->find(),
            ['User.id' => 2]
        )->hydrate(false)->extract('id')->toArray();
        $expected = [];
        $this->assertEquals($expected, $actual);
    }

    public function testFindAccessibleBy()
    {
        $actual = $this->Contacts
            ->findAccessibleBy(
                $this->Contacts->find(),
                [
                    'User.id' => 2
                ]
            )
            ->extract('id')
            ->toArray();
        $expected = [2, 3, 4, 5, 1, 6];
        $this->assertEquals($expected, $actual);

        $actual = $this->Contacts
            ->findAccessibleBy(
                $this->Contacts->find(),
                [
                    'User.id' => 1
                ]
            )
            ->extract('id')
            ->toArray();
        $expected = [1, 2, 5, 6, 7];
        $this->assertEquals($expected, $actual);
    }

    public function testIsAccessibleAsContactPerson()
    {
        //testing private method
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('isAccessibleAsContactPerson');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, 6, 3);
        $this->assertTrue($actual);

        $actual = $method->invoke($this->Contacts, 6, 1);
        $this->assertFalse($actual);
    }

    public function testIsAccessibleAsGroupMember()
    {
        //testing private method
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('isAccessibleAsGroupMember');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, 6, 2);
        $this->assertTrue($actual);

        $actual = $method->invoke($this->Contacts, 7, 2);
        $this->assertFalse($actual);
    }

    public function testIsAccessibleAsUsergroupMember()
    {
        //testing private method
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('isAccessibleAsUsergroupMember');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, 6, 1);
        $this->assertTrue($actual);

        $actual = $method->invoke($this->Contacts, 6, 2);
        $this->assertFalse($actual);
    }

    public function testIsAccessible()
    {
        $actual = $this->Contacts->isAccessible(1, 1);
        $this->assertTrue($actual);

        $actual = $this->Contacts->isAccessible(1, 3);
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

    public function testHasAccess()
    {
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
                    'groupMembers' => [1, 2],
                    'usergroupMembers' => []];
        $this->assertEquals($expected, $actual);

        $actual = $this->filterHasAccess($this->Contacts->hasAccess(6));
        $expected = ['contactPersons' => [3],
                    'groupMembers' => [2],
                    'usergroupMembers' => [1, 3]];
        $this->assertEquals($expected, $actual);
    }

    public function testTranslateCode2SQL()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('translateCode2SQL');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, '%', 'contactname', 'Gábor');
        $expected = 'contactname LIKE "%Gábor%"';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '=', 'contactname', 'Gábor');
        $expected = 'contactname = "Gábor"';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '=', 'length', 5);
        $expected = 'length = 5';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '!', 'contactname', 'Gábor');
        $expected = 'contactname != "Gábor"';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '!', 'length', 5);
        $expected = 'length != 5';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '<', 'contactname', 'Zz');
        $expected = 'contactname < "Zz"';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '<', 'length', 5);
        $expected = 'length < 5';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '>', 'contactname', 'Zz');
        $expected = 'contactname > "Zz"';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, '>', 'length', 5);
        $expected = 'length > 5';
        $this->assertEquals($expected, $actual);
    }

    public function testGetTableName()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('getTableName');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, 'Contacts.contactname');
        $expected = 'Contacts';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, 'Histories.date');
        $expected = 'Histories';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, 'Histories.Events.name');
        $expected = 'Histories.Events';
        $this->assertEquals($expected, $actual);
    }

    public function testGetFieldName()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('getFieldName');
        $method->setAccessible(true);

        $actual = $method->invoke($this->Contacts, 'Contacts.contactname');
        $expected = 'Contacts.contactname';
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke($this->Contacts, 'Histories.Events.name');
        $expected = 'Events.name';
        $this->assertEquals($expected, $actual);
    }

        public function testRemoveEmptyConditions()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('removeEmptyConditions');
        $method->setAccessible(true);

        $actual = $method->invoke(
            $this->Contacts,
            [
                'Contacts.contactname' => [
                    'condition' => ['&%'],
                    'value' => ['']
                ],
                'Zips.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['Balaton']
                ],
                'Groups.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['']
                ],
                'Groups.shared' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => [1]
                ]
            ]
        );
        $expected = [
            'Zips.name' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['Balaton']
            ],
            'Groups.shared' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => [1]
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testGetWhereQueryExpressionObject()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('getWhereQueryExpressionObject');
        $method->setAccessible(true);

        $queryExpressionObject = $method->invoke(
            $this->Contacts,
            [
                'Contacts.contactname' => [
                    'condition' => ['&%'],
                    'value' => ['Gábor']
                ],
                'Contacts.legalname' => [
                    'connect' => '|',
                    'condition' => ['&%'],
                    'value' => ['Gábor']
                ]
            ]
        );
        $generator = $this->Contacts->find()->valueBinder();
        $actual = ($queryExpressionObject->sql($generator));
        $expected = '( Contacts.contactname LIKE "%Gábor%") OR ( Contacts.legalname LIKE "%Gábor%")';
        $this->assertEquals($expected, $actual);

        $queryExpressionObject = $method->invoke(
            $this->Contacts,
            [
                'Zips.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['Balaton']
                ]
            ]
        );
        $generator = $this->Contacts->find()->valueBinder();
        $actual = ($queryExpressionObject->sql($generator));
        $expected = 'Zips.name LIKE "%Balaton%"';
        $this->assertEquals($expected, $actual);

        $queryExpressionObject = $method->invoke(
            $this->Contacts,
            [
                'Histories.date' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['-10-']
                ],
                'Histories.Events.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['email']
                ]
            ]
        );
        $generator = $this->Contacts->find()->valueBinder();
        $actual = ($queryExpressionObject->sql($generator));
        $expected = 'Histories.date LIKE "%-10-%" AND ( Events.name LIKE "%email%")';
        $this->assertEquals($expected, $actual);
    }

    public function testGetPart()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('getPart');
        $method->setAccessible(true);

        $where = [
            'Contacts.contactname' => [
                'condition' => ['&%'],
                'value' => ['goura']
            ],
            'Contacts.legalname' => [
                'connect' => '|',
                'condition' => ['&%'],
                'value' => ['hari']
            ],
            'Zips.name' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['']
            ],
            'WorkplaceZips.name' => [
                'connect' => '&',
                'condition' => ['&%','|%'],
                'value' => ['buda', 'pest']
            ],
            'Groups.name' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['']
            ],
            'Histories.date' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['-10-']
            ],
            'Histories.Events.name' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['email']
            ]
        ];

        $actual = $method->invoke($this->Contacts, 'Contacts', $where);
        $expected = [
            'Contacts.contactname' => [
                'condition' => ['&%'],
                'value' => ['goura']
            ],
            'Contacts.legalname' => [
                'connect' => '|',
                'condition' => ['&%'],
                'value' => ['hari']
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testGetAssociationsArrays()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('getAssociationsArrays');
        $method->setAccessible(true);

        $actual = $method->invoke(
            $this->Contacts,
            [
                '_contain' => ['Zips'],
                '_where' => [
                    'Contacts.contactname' => [
                        'condition' => ['&%'],
                        'value' => ['']
                    ],
                    'Groups.name' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => ['']
                    ],
                    'Groups.shared' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => [1]
                    ]
                ]
            ]
        );
        $expected = [
            [],
            [],
            [
                'Groups.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['']
                ],
                'Groups.shared' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => [1]
                ]
            ]
        ];
        $this->assertEquals($expected, $actual);

        $actual = $method->invoke(
            $this->Contacts,
            [
                'User.id' => 2,
                '_contain' => ['Zips', 'WorkplaceZips', 'Groups', 'Histories'],
                '_limit' => 20,
                '_order' => ['Contacts.contactname' => 'ASC'],
                '_page' => 1,
                '_select' => ['Contacts.active', 'Contacts.id', 'Contacts.sex', 'Contacts.contactname',
                    'Contacts.legalname', 'Zips.name', 'WorkplaceZips.name', 'Groups.name', 'Histories.date',
                    'Events.name'],
                '_where' => [
                    'Contacts.contactname' => [
                        'condition' => ['&%'],
                        'value' => ['Gábor']
                    ],
                    'Contacts.legalname' => [
                        'connect' => '|',
                        'condition' => ['&%'],
                        'value' => ['Gábor']
                    ],
                    'Zips.name' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => ['']
                    ],
                    'WorkplaceZips.name' => [
                        'connect' => '&',
                        'condition' => ['&%', '|%'],
                        'value' => ['buda', 'pest']
                    ],
                    'Groups.name' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => ['']
                    ],
                    'Histories.date' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => ['-10-']
                    ],
                    'Histories.Events.name' => [
                        'connect' => '&',
                        'condition' => ['&%'],
                        'value' => ['email']
                    ]
                ]
            ]);
        $expected = [
            [
                'Zips.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['']
                ],
                'WorkplaceZips.name' => [
                    'connect' => '&',
                    'condition' => ['&%', '|%'],
                    'value' => ['buda', 'pest']
                ]
            ],
            [
                'Histories.date' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['-10-']
                ],
                'Histories.Events.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['email']
                ]
            ],
            [
                'Groups.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['']
                ]
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    private function filterHasAccess($actual)
    {
        foreach ($actual as $type => $a) {
            foreach ($a as $i => $user) {
                $actual[$type][$i] = $user->id;
            }
            sort($actual[$type]);
        }
        //debug($actual);
        return $actual;
    }

    public function testSortByDots()
    {
        $class = new \ReflectionClass($this->Contacts);
        $method = $class->getMethod('sortByDots');
        $method->setAccessible(true);

        $actual = $method->invoke(
            $this->Contacts,
            [
                'Histories.date' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['-10-']
                ],
                'Histories.Events.name' => [
                    'connect' => '&',
                    'condition' => ['&%'],
                    'value' => ['email']
                ]
            ]
        );
        $expected = [
            'Histories.Events.name' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['email']
            ],
            'Histories.date' => [
                'connect' => '&',
                'condition' => ['&%'],
                'value' => ['-10-']
            ]
        ];
        $this->assertEquals($expected, $actual);
    }


        /**
 * Test initialize method
 *
 * @return void
 */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test validationDefault method
 *
 * @return void
 */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test beforeSave method
 *
 * @return void
 */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test afterSave method
 *
 * @return void
 */
    public function testAfterSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
