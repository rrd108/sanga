<nav class="primary">
    <div id="hamburger">
        <span></span>
    </div>
    <div class="main-logo">
        <?php echo $this->Html->image('logo-main-big.png', ['alt' => 'Sanga logo', 'url' => '/']); ?>
    </div>
    <div id="menu">
        <ul>
            <?php if ($this->request->getSession()->read('Auth.User.id')) : ?>
            <?php if ($this->request->getSession()->read('Auth.User.role') == 10) : ?>
            <li>
                <i class="fi-key"></i> <?= __('Admin') ?>
                <ul>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-compass"></i> ' . __('Zips'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Zips'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-trees"></i> ' . __('Countries'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Countries',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-graph-bar"></i> ' . __('Units'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Units',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-torsos"></i> ' . __('Users'),
                            [
                                'plugin' => null,
                                'prefix' => 'admin',
                                'controller' => 'Users',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-plus"></i> ' . __('New user'),
                            [
                                'plugin' => null,
                                'prefix' => 'admin',
                                'controller' => 'Users',
                                'action' => 'add'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-torsos-all"></i> ' . __('User groups'),
                            [
                                'plugin' => null,
                                'prefix' => 'admin',
                                'controller' => 'Usergroups',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-target-two"></i> ' . __('Groups'),
                            [
                                'plugin' => null,
                                'prefix' => 'admin',
                                'controller' => 'Groups',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-skull"></i> ' . __('Brute forces'),
                            [
                                'plugin' => 'RBruteForce',
                                'prefix' => false,
                                'controller' => 'Rbruteforces'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-skull"></i> ' . __('Brute force logs'),
                            [
                                'plugin' => 'RBruteForce',
                                'prefix' => false,
                                'controller' => 'Rbruteforcelogs'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <li>
                <i class="fi-anchor"></i> <?= __('CRM') ?>
                <ul>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-heart"></i> ' . __('Contacts'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-plus"></i> ' . __('Add Contact'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'add'
                            ],
                            ['escape' => false]
                        )  ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-flag"></i> ' . __('Histories'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Histories',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-crown"></i> ' . __('Queries'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'searchquery'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-target-two"></i> ' . __('Groups'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Groups',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-map"></i> ' . __('Map'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'showmap'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fi-arrow-right"></i> <?= __('Import') ?>
                <ul>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-arrow-right"></i> ' . __('Google Contact Import'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contacts',
                                'action' => 'google'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-arrow-right"></i> ' . __('Contact Import'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Imports',
                                'action' => 'contacts'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-arrow-right"></i> ' . __('History Import'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Imports',
                                'action' => 'histories'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fi-target"></i> <?= __('Master data') ?>
                <ul>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-torsos"></i> ' . __('Users'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Users',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-torsos-all"></i> ' . __('User groups'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Usergroups',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <?php if (in_array($this->request->getSession()->read('Auth.User.role'), [9, 10])) : ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-die-two"></i> ' . __('Contact sources'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Contactsources',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-puzzle"></i> ' . __('Skills'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Skills',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <?php endif ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-paw"></i> ' . __('Events'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Events',
                                'action' => 'index'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fi-widget"></i> <?= $this->request->getSession()->read('Auth.User.realname') ?>
                <?php print $cell = $this->cell('Notification', [$this->request->getSession()->read('Auth.User.id')]); ?>
                <ul>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-widget"></i> ' . __('Profile'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Users',
                                'action' => 'profile'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-info"></i> ' . __('Help'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'pages',
                                'action' => 'help'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-alert"></i> ' . __('Notifications') . $cell,
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Notifications',
                                'action' => 'index'
                            ],
                            ['escape' => false, 'escapeTitle' => false]
                        ) ?>
                    </li>
                    <?php if ($this->request->getSession()->read('switchUser')) : ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-key"></i> ' . __('Back to admin'),
                            [
                                'plugin' => null,
                                'prefix' => 'admin',
                                'controller' => 'Users',
                                'action' => 'personalize/' . $this->request->getSession()->read('Auth.User.id')
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                    <?php endif; ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fi-power"></i> ' . __('Logout'),
                            [
                                'plugin' => null,
                                'prefix' => false,
                                'controller' => 'Users',
                                'action' => 'logout'
                            ],
                            ['escape' => false]
                        ) ?>
                    </li>
                </ul>
                <?php endif; ?>
            </li>

            <?php if ($this->request->getSession()->read('Auth.User.id')) : ?>
            <div class="header-search">
                <?= $this->Form->create(
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
                ) ?>
                <?= $this->Form->control(
                    'quickterm',
                    [
                        'label' => false,
                        'placeholder' => __('Search')
                    ]
                ) ?>
                <?= $this->Form->end() ?>
                <?php endif ?>
            </div>
        </ul>
    </div>
</nav>