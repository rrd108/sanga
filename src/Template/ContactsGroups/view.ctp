<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Contacts Group'), ['action' => 'edit', $contactsGroup->group_id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Contacts Group'), ['action' => 'delete', $contactsGroup->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsGroup->group_id)]) ?> </li>
            <li><?= $this->Html->link(__('List Contacts Groups'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contacts Group'), ['action' => 'add']) ?> </li>
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
        <div class="contactsGroups view large-10 medium-9 columns">
            <h2><?= h($contactsGroup->group_id) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('Group') ?></h6>
                    <p><?= $contactsGroup->has('group') ? $this->Html->link($contactsGroup->group->name, ['controller' => 'Groups', 'action' => 'view', $contactsGroup->group->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('Contact') ?></h6>
                    <p><?= $contactsGroup->has('contact') ? $this->Html->link($contactsGroup->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsGroup->contact->id]) : '' ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
