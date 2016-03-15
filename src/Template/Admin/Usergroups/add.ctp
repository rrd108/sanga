<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Usergroups'), ['action' => 'index']) ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="usergroups form large-10 medium-9 columns">
        <?= $this->Form->create($usergroup) ?>
            <fieldset>
                <legend><?= __('Add Usergroup') ?></legend>
            <?php
                echo $this->Form->input('name');
                echo $this->Form->input('admin_user_id', ['options' => $users]);
                echo $this->Form->input('users._ids', ['options' => $users]);
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
