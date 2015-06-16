<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # %s?', $notification->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="notifications view large-10 medium-9 columns">
            <h2><?= h($notification->id) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('User') ?></h6>
                    <p><?= $notification->has('user') ? $this->Html->link($notification->user->id, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('Notification') ?></h6>
                    <p><?= h($notification->notification) ?></p>
                </div>
                <div class="large-2 larege-offset-1 columns numbers end">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($notification->id) ?></p>
                </div>
                <div class="large-2 columns dates end">
                    <h6 class="subheader"><?= __('Created') ?></h6>
                    <p><?= h($notification->created) ?></p>
                </div>
                <div class="large-2 columns booleans end">
                    <h6 class="subheader"><?= __('Unread') ?></h6>
                    <p><?= $notification->unread ? __('Yes') : __('No'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
