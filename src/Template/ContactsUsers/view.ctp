<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Contacts User'), ['action' => 'edit', $contactsUser->contact_id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Contacts User'), ['action' => 'delete', $contactsUser->contact_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsUser->contact_id)]) ?> </li>
            <li><?= $this->Html->link(__('List Contacts Users'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contacts User'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="contactsUsers view large-10 medium-9 columns">
            <h2><?= h($contactsUser->contact_id) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('Contact') ?></h6>
                    <p><?= $contactsUser->has('contact') ? $this->Html->link($contactsUser->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsUser->contact->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('User') ?></h6>
                    <p><?= $contactsUser->has('user') ? $this->Html->link($contactsUser->user->name, ['controller' => 'Users', 'action' => 'view', $contactsUser->user->id]) : '' ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
