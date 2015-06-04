<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Documents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="documents form large-10 medium-9 columns">
    <?= $this->Form->create($document) ?>
    <fieldset>
        <legend><?= __('Add Document') ?></legend>
        <?php
            echo $this->Form->input('contact_id', ['options' => $contacts]);
            echo $this->Form->input('name');
            echo $this->Form->input('file_name');
            echo $this->Form->input('file_type');
            echo $this->Form->input('size');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
