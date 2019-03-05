<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Contacts Skill'), ['action' => 'edit', $contactsSkill->contact_id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Contacts Skill'), ['action' => 'delete', $contactsSkill->contact_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsSkill->contact_id)]) ?> </li>
            <li><?= $this->Html->link(__('List Contacts Skills'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contacts Skill'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsSkills view large-10 medium-9 columns">
            <h2><?= h($contactsSkill->contact_id) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('Contact') ?></h6>
                    <p><?= $contactsSkill->has('contact') ? $this->Html->link($contactsSkill->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsSkill->contact->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('Skill') ?></h6>
                    <p><?= $contactsSkill->has('skill') ? $this->Html->link($contactsSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $contactsSkill->skill->id]) : '' ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
