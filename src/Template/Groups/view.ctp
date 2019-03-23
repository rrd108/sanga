<?= $this->Html->script('sanga.groups.view.js', ['block' => true]) ?>

<div class="groups view small-12 columns">
    <?php if (isset($group)) : ?>
        <div class="row">
            <div class="column small-8">
                <h1><?= h($group->name) ?></h1>
            </div>
            <div class="column small-4">
                <?php if ($isWritable) : ?>
                    <?= $this->Html->link(
                        __('Save as CSV'),
                        [
                            'controller' => 'Groups',
                            'action' => 'view',
                            h($group->id),
                            '_ext' => 'csv',
                        ],
                        [
                            'class' => 'button radius',
                        ]
                    ) ?>
                <?php endif ?>
            </div>
        </div>

        <div class="row small-up-2 large-up-5">
            <h6 class="subheader column">
                <?= __('Description') ?> :
                <?= h($group->description) ?>
            </h6>
            <h6 class="subheader column">
                <?= __('Admin User') ?> :
                <?= $group->admin_user->name ?>
            </h6>
            <h6 class="subheader column">
                <?= __('Shared') ?> :
                <?= $group->shared ? __('Yes') : __('No'); ?>
            </h6>
            <h6 class="subheader column">
                <?= __('Members') ?> :
                <?= count($group->contacts); ?>
            </h6>
            <h6 class="subheader column">
                <?= __('Has access as group member') ?>
                <?php if (!empty($group->users)): ?>
                    <?php foreach ($group->users as $users): ?>
                        <?= h($users->name) ?> |
                    <?php endforeach; ?>
                <?php endif; ?>
            </h6>
        </div>

        <div class="row">
            <div class="small-12 columns">
                <h2 class="subheader"><?= __('Add Contacts to this Group') ?></h2>
                <?php
                print $this->Form->create(null, ['id' => 'addMember']);
                print $this->Form->input('name', ['label' => __('Contactname or Legalname')]);
                print $this->Form->end();
                ?>
            </div>
        </div>

        <?php if ($isWritable) : ?>
            <div class="row">
                <div class="column small-12">
                    <h4 class="subheader"><?= __('Group Members') ?></h4>
                    <?php
                    echo $this->element(
                        'contacts_table',
                        [
                            'fields' => ['contactname', 'email', 'phone'],
                            'contacts' => $group->contacts,
                            'settings' => false
                        ]
                    );
                    ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
