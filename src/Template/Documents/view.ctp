<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Document'), ['action' => 'edit', $document->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Document'), ['action' => 'delete', $document->id], ['confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="documents view large-10 medium-9 columns">
    <h2><?= h($document->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Contact') ?></h6>
            <p><?= $document->has('contact') ? $this->Html->link($document->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $document->contact->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($document->name) ?></p>
            <h6 class="subheader"><?= __('File Name') ?></h6>
            <p><?= h($document->file_name) ?></p>
            <h6 class="subheader"><?= __('File Type') ?></h6>
            <p><?= h($document->file_type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($document->id) ?></p>
            <h6 class="subheader"><?= __('Size') ?></h6>
            <p><?= $this->Number->format($document->size) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($document->created) ?></p>
        </div>
    </div>
</div>
