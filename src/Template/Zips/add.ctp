<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="zips form large-10 medium-9 columns">
        <?= $this->Form->create($zip) ?>
            <fieldset>
                <legend><?= __('Add Zip'); ?></legend>
            <?php
                echo $this->Form->input('country_id', ['options' => $countries]);
                echo $this->Form->input('zip');
                echo $this->Form->input('name');
                echo $this->Form->input('lat');
                echo $this->Form->input('lng');
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
