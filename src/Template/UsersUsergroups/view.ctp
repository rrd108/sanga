<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Users Usergroup'), ['action' => 'edit', $usersUsergroup->user_id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Users Usergroup'), ['action' => 'delete', $usersUsergroup->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersUsergroup->user_id)]) ?> </li>
            <li><?= $this->Html->link(__('List Users Usergroups'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Users Usergroup'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Usergroups'), ['controller' => 'Usergroups', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Usergroup'), ['controller' => 'Usergroups', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="usersUsergroups view large-10 medium-9 columns">
            <h2><?= h($usersUsergroup->user_id) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('User') ?></h6>
                    <p><?= $usersUsergroup->has('user') ? $this->Html->link($usersUsergroup->user->name, ['controller' => 'Users', 'action' => 'view', $usersUsergroup->user->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('Usergroup') ?></h6>
                    <p><?= $usersUsergroup->has('usergroup') ? $this->Html->link($usersUsergroup->usergroup->name, ['controller' => 'Usergroups', 'action' => 'view', $usersUsergroup->usergroup->id]) : '' ?></p>
                </div>
                <div class="large-2 large-offset-1 columns numbers end">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($usersUsergroup->id) ?></p>
                </div>
                <div class="large-2 columns booleans end">
                    <h6 class="subheader"><?= __('Admin') ?></h6>
                    <p><?= $usersUsergroup->admin ? __('Yes') : __('No'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
