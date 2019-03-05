<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Groups User'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="groupsUsers index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('group_id') ?></th>
                        <th><?= $this->Paginator->sort('user_id') ?></th>
                        <th><?= $this->Paginator->sort('intersection_group_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupsUsers as $groupsUser) : ?>
                    <tr>
                        <td><?= $this->Number->format($groupsUser->id) ?></td>
                        <td><?= $this->Number->format($groupsUser->group_id) ?></td>
                        <td>
                            <?= $groupsUser->has('user') ? $this->Html->link($groupsUser->user->name, ['controller' => 'Users', 'action' => 'view', $groupsUser->user->id]) : '' ?>
                        </td>
                        <td>
                            <?= $groupsUser->has('group') ? $this->Html->link($groupsUser->group->name, ['controller' => 'Groups', 'action' => 'view', $groupsUser->group->id]) : '' ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $groupsUser->group_id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $groupsUser->group_id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $groupsUser->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupsUser->group_id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>