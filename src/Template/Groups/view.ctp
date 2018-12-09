<?php
print $this->Html->script('sanga.groups.view.js', ['block' => true]);
print $this->Html->css('daterangepicker.css', ['block' => true]);

print $this->Html->script('sanga.add.history.entry.js', ['block' => true]);
print $this->Html->script('sanga.histories.index.js', ['block' => true]);

print $this->Html->script('moment.min.js', ['block' => true]);
print $this->Html->script('jquery.daterangepicker.js', ['block' => true]);
?>
<div class="groups view large-12 columns">
    <?php if (isset($group)) : ?>
        <div class="related row">
            <div class="column large-12">
                <div class="fr">
                    <?php
                    if ($isWritable) {
                        print $this->Html->link(
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
                        );
                    }
                    ?>
                </div>

                <h1><?= h($group->name) ?></h1>
                <div class="row">
                    <div class="large-6 columns strings">
                        <h6 class="subheader">
                            <?= __('Description') ?> :
                            <?= h($group->description) ?>
                        </h6>
                        <h6 class="subheader">
                            <?= __('Admin User') ?> :
                            <?= $group->admin_user->name ?>
                        </h6>
                        <h6 class="subheader">
                            <?= __('Shared') ?> :
                            <?= $group->shared ? __('Yes') : __('No'); ?>
                        </h6>
                        <h6 class="subheader">
                            <?= __('Members') ?> :
                            <?= count($group->contacts); ?>
                        </h6>
                        <h6 class="subheader">
                            <?= __('Has access as group member') ?>
                            <?php if (!empty($group->users)): ?>
                                <?php foreach ($group->users as $users): ?>
                                    <?= h($users->name) ?> |
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </h6>
                    </div>

                    <div class="large-6 columns strings">
                        <h4 class="subheader"><?= __('Add Contacts to this Group') ?></h4>
                        <?php
                        print $this->Form->create(null, ['id' => 'addMember']);
                        print $this->Form->input('name', ['label' => __('Contactname or Legalname')]);
                        print $this->Form->end();
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($isWritable) :
            ?>
            <div class="related row">
                <div class="row">
                    <div class="column large-6">
                        <h4 class="subheader"><?= __('Group Members') ?></h4>
                        <?php
                        echo $this->element(
                            'contacts_table',
                            [
                                'fields' => ['contactname'],
                                'contacts' => $group->contacts,
                                'settings' => false
                            ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
