<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsSkill->contact_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsSkill->contact_id)]) ?></li>
            <li><?= $this->Html->link(__('List Contacts Skills'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsSkills form large-10 medium-9 columns">
        <?= $this->Form->create($contactsSkill) ?>
            <fieldset>
                <legend><?= __('Edit Contacts Skill') ?></legend>
            <?php
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
