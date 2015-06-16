<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsGroup->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsGroup->group_id)]) ?></li>
            <li><?= $this->Html->link(__('List Contacts Groups'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="contactsGroups form large-10 medium-9 columns">
        <?= $this->Form->create($contactsGroup) ?>
            <fieldset>
                <legend><?= __('Edit Contacts Group') ?></legend>
            <?php
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
