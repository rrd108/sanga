<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="units index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($units as $unit) : ?>
                    <tr>
                        <td><?= $this->Number->format($unit->id) ?></td>
                        <td><?= h($unit->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $unit->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $unit->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>