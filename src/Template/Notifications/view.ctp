<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="notifications view large-10 medium-9 columns">
            <h2><?= __('Notification') ?></h2>
            <div class="row">
                <div class="large-10 columns strings">
                    <h6 class="subheader"><?= __('Sender') ?></h6>
                    <p>
                        <?= $notification->sender->realname . ' (' . $notification->sender->name . ')' ?>
                    </p>
                    <h6 class="subheader"><?= __('Notification') ?></h6>
                    <p><?= $notification->notification ?></p>
                    <h6 class="subheader"><?= __('Created') ?></h6>
                    <p><?= h($notification->created) ?></p>
                    <h6 class="subheader"><?= __('Status') ?></h6>
                    <p><?= $notification->unread ? __('Unread') : __('Read'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
