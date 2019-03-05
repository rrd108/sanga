<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Family'), ['action' => 'add']) ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="families index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($families as $family) : ?>
                    <tr>
                        <td><?= $this->Number->format($family->id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $family->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $family->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete # {0}?', $family->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>