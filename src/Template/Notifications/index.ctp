<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?></li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <h3><?= __('Unread notifications') ?></h3>
        <div class="notifications index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('sender_realname') ?></th>
                        <th><?= $this->Paginator->sort('notification') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newNotifications as $notification) : ?>
                    <tr class="b">
                        <td><?= h($notification->sender->realname) ?></td>
                        <td>
                            <?php
                            echo $this->Html->link(
                                $this->Text->truncate(
                                    $this->Text->stripLinks(
                                        $notification->notification
                                    )
                                ),
                                ['action' => 'view', $notification->id]
                            );
                            ?>
                        </td>
                        <td><?= h($notification->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Reply'), ['action' => 'add', $notification->sender->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>

    <div class="row">
        <h3><?= __('Read notifications') ?></h3>
        <div class="notifications index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('sender_realname') ?></th>
                        <th><?= $this->Paginator->sort('notification') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($readNotifications as $notification) : ?>
                    <tr>
                        <td><?= h($notification->sender->realname) ?></td>
                        <td>
                            <?php
                            echo $this->Html->link(
                                $this->Text->truncate(
                                    $this->Text->stripLinks(
                                        $notification->notification
                                    )
                                ),
                                ['action' => 'view', $notification->id]
                            );
                            ?>
                        </td>
                        <td><?= h($notification->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Reply'), ['action' => 'add', $notification->sender->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>

    <div class="row">
        <h3><?= __('Sent notifications') ?></h3>
        <div class="notifications index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('realname') ?></th>
                        <th><?= $this->Paginator->sort('notification') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sentNotifications as $notification) : ?>
                    <tr>
                        <td><?= h($notification->user->realname) ?></td>
                        <td>
                            <?php
                            echo $this->Html->link(
                                $this->Text->truncate(
                                    $this->Text->stripLinks(
                                        $notification->notification
                                    )
                                ),
                                ['action' => 'view', $notification->id]
                            );
                            ?>
                        </td>
                        <td><?= h($notification->created) ?></td>
                        <td class="actions">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>

</div>