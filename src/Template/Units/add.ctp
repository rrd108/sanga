<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper">
    <div class="row">
        <div class="units form large-10 medium-9 columns">
        <?= $this->Form->create($unit) ?>
            <fieldset>
                <legend><?= __('Add Unit'); ?></legend>
            <?php
                echo $this->Form->input('name');
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
