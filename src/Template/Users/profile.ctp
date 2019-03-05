<?= $this->Html->script('sanga.users.profile.min', ['block' => true]) ?>
<div class="large-10 medium-9 columns">
    <?= $this->Html->link(
        '<i class="fi-pencil"></i>',
        ['action' => 'edit', $user->id],
        ['id' => 'editlink', 'class' => 'column large-1 hidden', 'escape' => false]
    ) ?>

   <?= $this->element('ajax-images') ?>

    <?= $this->Form->create($user, ['id' => 'editForm', 'url' => ['action' => 'edit', $user->id]]) ?>
    <div class="user-details-view">
        <div class="main-title row">
            <div class="column large-12">
                <h2><?= h($user->name) ?></h2>
            </div>
        </div>
        <div class="row align-center">
            <div class="column large-9">
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Name') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;<?= h($user->name) ?></span>
                            <?php
                            print $this->Form->input(
                                'name',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->name)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Password') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;******</span>
                            <?php
                            print $this->Form->input(
                                'password',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => false
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Realname') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;<?= h($user->realname) ?></span>
                            <?php
                            print $this->Form->input(
                                'realname',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->realname)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Email') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;<?= h($user->email) ?></span>
                            <?php
                            print $this->Form->input(
                                'email',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->email)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Phone') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;<?= h($user->phone) ?></span>
                            <?php
                            print $this->Form->input(
                                'phone',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->phone)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Responsible') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">
                            <span class="dta">&nbsp;<?= h($user->responsible) ?></span>
                            <?php
                            print $this->Form->input(
                                'responsible',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->responsible)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Role') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="value"><?= $this->Number->format($user->role) ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Language') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="ed">

                            <span class="dta">&nbsp;<?= h($user->locale) ?></span>
                            <?php
                            print $this->Form->input(
                                'locale',
                                [
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'class' => 'editbox',
                                    'label' => false,
                                    'value' => h($user->locale)
                                ]
                            );
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Created') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="value"><?= h($user->created) ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Modified') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="value"><?= h($user->modified) ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column large-5">
                        <p><?= __('Active') ?></p>
                    </div>
                    <div class="column large-6">
                        <p class="value"><?= $user->active ? __('Yes') : __('No'); ?></p>
                    </div>
                </div>
            </div>
            <!-- user profile details -->
        </div>
    </div>
    <!-- user detaisl view -->


    <div class="user-details-view">
        <div class="row">
            <div class="column large-12">
                <h4 class="subheader"><?= __('Events') ?></h4>
                <?php if (!empty($user->events)) : ?>
                <?php
                foreach ($user->events as $events) :
                    print $this->Html->link(
                        h($events->name),
                        [
                            'controller' => 'Events',
                            'action' => 'view', $events->id
                        ]
                    );
                endforeach;
                ?>
                <?php endif; ?>
            </div><!-- column -->
        </div>
    </div>
    <!-- user detaisl view -->

    <div class="user-details-view">
        <div class="row">
            <div class="column large-12">
                <h4 class="subheader"><?= __('Usergroups') ?></h4>
                <?php if (!empty($user->usergroups)) : ?>
                <?php foreach ($user->usergroups as $usergroups) : ?>
                <?= $this->Html->link(h($usergroups->name), ['controller' => 'Usergroups', 'action' => 'view', $usergroups->id]) ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- column -->
        </div>
    </div>
    <!-- user detaisl view -->
    <?php
    print $this->Form->end();
    ?>
</div>