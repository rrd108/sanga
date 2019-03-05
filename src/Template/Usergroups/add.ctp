<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Usergroups'), ['action' => 'index']) ?></li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="usergroups form large-10 medium-9 columns">
        <?= $this->Form->create($usergroup) ?>
            <fieldset>
                <legend><?= __('Add Usergroup') ?></legend>
            <?php
                echo $this->Form->input('name');
                echo $this->Form->input('users._ids', ['options' => $users]);
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
