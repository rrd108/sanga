<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # %s?', $unit->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="units view large-10 medium-9 columns">
            <h2><?= h($unit->name) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('Name') ?></h6>
                    <p><?= h($unit->name) ?></p>
                </div>
                <div class="large-2 large-offset-1 columns numbers end">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($unit->id) ?></p>
                </div>
            </div>
        </div>
        <div class="related row">
            <div class="column large-12">
            <h4 class="subheader"><?= __('Related Histories') ?></h4>
            <?php if (!empty($unit->histories)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Contact Id') ?></th>
                    <th><?= __('Date') ?></th>
                    <th><?= __('User Id') ?></th>
                    <th><?= __('Linkup Id') ?></th>
                    <th><?= __('Event Id') ?></th>
                    <th><?= __('Detail') ?></th>
                    <th><?= __('Quantity') ?></th>
                    <th><?= __('Unit Id') ?></th>
                    <th><?= __('Group Id') ?></th>
                    <th><?= __('Created') ?></th>
                    <th><?= __('Modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($unit->histories as $histories): ?>
                <tr>
                    <td><?= h($histories->id) ?></td>
                    <td><?= h($histories->contact_id) ?></td>
                    <td><?= h($histories->date) ?></td>
                    <td><?= h($histories->user_id) ?></td>
                    <td><?= h($histories->linkup_id) ?></td>
                    <td><?= h($histories->event_id) ?></td>
                    <td><?= h($histories->detail) ?></td>
                    <td><?= h($histories->quantity) ?></td>
                    <td><?= h($histories->unit_id) ?></td>
                    <td><?= h($histories->group_id) ?></td>
                    <td><?= h($histories->created) ?></td>
                    <td><?= h($histories->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # %s?', $histories->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
