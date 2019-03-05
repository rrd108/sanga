<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="countries form large-10 medium-9 columns">
        <?= $this->Form->create($country) ?>
            <fieldset>
                <legend><?= __('Add Country') ?></legend>
            <?php
                echo $this->Form->input('name');
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
