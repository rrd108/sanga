    <nav class="primary">
    <div class="main-logo">
        <?php echo $this->Html->image('logo-main-big.png', ['alt' => 'Sanga logo', 'url' => '/']); ?>
    </div>
        <ul class="sf-menu">
            <?php
            if($this->request->session()->read('Auth.User.id')):
                if($this->request->session()->read('Auth.User.role') == 10):
            ?>
                <li>
                    <?= __('Admin') ?>
                    <ul>
                        <?php
                            print '<li>' .
                                $this->Html->link(
                                    '❶ ' . __('Zips'),
                                    [
                                        'plugin' => null,
                                        'prefix' => false,
                                        'controller' => 'Zips'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '☢ ' . __('Countries'),
                                    [
                                        'plugin' => null,
                                        'prefix' => false,
                                        'controller' => 'Countries',
                                        'action' => 'index'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '❖ ' . __('Units'),
                                    [
                                        'plugin' => null,
                                        'prefix' => false,
                                        'controller' => 'Units',
                                        'action' => 'index'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '☻ ' . __('Users'),
                                    [
                                        'plugin' => null,
                                        'prefix' => 'admin',
                                        'controller' => 'Users',
                                        'action' => 'index'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '✋ ' . __('User groups'),
                                    [
                                        'plugin' => null,
                                        'prefix' => 'admin',
                                        'controller' => 'Usergroups',
                                        'action' => 'index'
                                    ]
                                ) .
                                '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '⁂ ' . __('Groups'),
                                    [
                                        'plugin' => null,
                                        'prefix' => 'admin',
                                        'controller' => 'Groups',
                                        'action' => 'index'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '❗ ' . __('Brute forces'),
                                    [
                                        'plugin' => 'RBruteForce',
                                        'prefix' => false,
                                        'controller' => 'Rbruteforces'
                                    ]
                                ) . '</li>';
                            print '<li>' .
                                $this->Html->link(
                                    '❗ ' . __('Brute force logs'),
                                    [
                                        'plugin' => 'RBruteForce',
                                        'prefix' => false,
                                        'controller' => 'Rbruteforcelogs'
                                    ]
                                ) . '</li>';
                        ?>
                    </ul>
                </li>
                <?php endif; ?>
                <li>
                    <?= __('CRM') ?>
                    <ul>
                        <?php
                        print '<li>'.
                            $this->Html->link(
                                '♥ ' . __('Contacts'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contacts',
                                    'action' => 'index'
                                ]
                            ) . '</li>';
                        print '<li>'.
                            $this->Html->link(
                                '⊕ ' . __('Add Contact'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contacts',
                                    'action' => 'add'
                                ]
                            ) . '</li>';
                        print '<li>' .
                            $this->Html->link(
                                '⚑ ' . __('Histories'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Histories',
                                    'action' => 'index'
                                ]
                            ) . '</li>';
                        print '<li>' .
                            $this->Html->link(
                                '♛ ' . __('Queries'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contacts',
                                    'action' => 'searchquery'
                                ]
                            ) . '</li>';
                        print '<li>' .
                            $this->Html->link(
                                '⁂ ' . __('Groups'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Groups',
                                    'action' => 'index'
                                ]
                            ) . '</li>';
                        print '<li>' .
                            $this->Html->link(
                                '✈ ' . __('Map'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contacts',
                                    'action' => 'showmap'
                                ]
                            ) . '</li>';
                        ?>
                    </ul>
                </li>
                <li>
                    <?= __('Import') ?>
                    <ul>
                        <?php
                        print '<li>'.
                            $this->Html->link(
                                '⇉ ' . __('Google Contact Import'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contacts',
                                    'action' => 'google'
                                ]
                            ) . '</li>';
                        print '<li>'.
                            $this->Html->link(
                                '⇉ ' . __('Contact Import'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Imports',
                                    'action' => 'contacts'
                                ]
                            ) . '</li>';
                        print '<li>'.
                            $this->Html->link(
                                '⇉ ' . __('History Import'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Imports',
                                    'action' => 'histories'
                                ]
                            ) . '</li>';
                        ?>
                    </ul>
                </li>
            <li>
                <?= __('Master data') ?>
                <ul>
                    <?php
                    print '<li>' .
                        $this->Html->link(
                            '✮ ' . __('Users'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Users',
                                'action' => 'index'
                            ]
                        ) .
                        '</li>';

                    print '<li>' .
                        $this->Html->link(
                            '✋ ' . __('User groups'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Usergroups',
                                'action' => 'index'
                            ]
                        ) .
                        '</li>';
                    if(in_array($this->request->session()->read('Auth.User.role'), [9,10])){
                        print '<li>' .
                            $this->Html->link(
                                '⚓ ' . __('Contact sources'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Contactsources',
                                    'action' => 'index'
                                ]
                            ) . '</li>';
                        print '<li>' .
                            $this->Html->link(
                                '✄ ' . __('Skills'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Skills',
                                    'action' => 'index'
                                ]
                            ) . '</li>';
                    }
                    print '<li>' .
                        $this->Html->link(
                            '✿ ' . __('Events'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Events',
                                'action' => 'index'
                            ]
                        ) . '</li>';
                    ?>
                </ul>
            </li>
            <li>

                <?php
                    print $this->request->session()->read('Auth.User.realname');
                    print $cell = $this->cell('Notification', [$this->request->session()->read('Auth.User.id')]);
                ?>
                <ul>
                    <?php
                        print '<li>' .
                            $this->Html->link(
                                '☭ ' . __('Profile'),
                                [
                                    'plugin' => null,
                                    'prefix' => false,
                                    'controller' => 'Users',
                                    'action' => 'profile'
                                ]
                            ) . '</li>';
                    print '<li>' .
                        $this->Html->link('❓ ' . __('Help'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'pages',
                                'action' => 'help'
                            ]
                        ) . '</li>';
                    print '<li>' .
                        $this->Html->link('⚠ ' . __('Notifications') . $cell,
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Notifications',
                                'action' => 'index'
                            ],
                            ['escapeTitle' => false]
                        ) . '</li>';
                    /*print '<li>' .
                        $this->Html->link('❣ ' . __('Duplicates'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'checkDuplicates'
                            ]
                        ) . '</li>';*/
                    if ($this->request->session()->read('switchUser')) {
                        print '<li>' .
                            $this->Html->link('⊗ ' . __('Back to admin'),
                                [
                                    'plugin' => null,
                                    'prefix' => 'admin',
                                    'controller' => 'Users',
                                    'action' => 'personalize/' . $this->request->session()->read('Auth.User.id')
                                ]
                            ) . '</li>';
                    }
                    print '<li>' .
                        $this->Html->link('⊗ ' . __('Logout'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Users',
                                'action' => 'logout'
                            ]
                        ) . '</li>';
                    ?>
                </ul>
                 <?php endif; ?>
            </li>

            <?php
             if($this->request->session()->read('Auth.User.id')):
             ?>
                <div class="header-search">
                   <?php
                      print $this->Form->create(
                         null,
                            [
                               'id' => 'qForm',
                               'url' => [
                               'plugin' => null,
                               'prefix' => false,
                               'controller' => 'Search',
                               'action' => 'quicksearch'
                                ]
                                ]
                                );
                                print $this->Form->input(
                                'quickterm',
                                [
                                'label' => false,
                                'placeholder' => __('Search')
                                ]
                                );
                                print $this->Form->end();
                                endif;?>
                                </div>

        </ul>
    </nav>


</div>
