<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Zip'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="zips index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('country_id') ?></th>
                    <th><?= $this->Paginator->sort('zip') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('lat') ?></th>
                    <th><?= $this->Paginator->sort('lng') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($zips as $zip): ?>
                <tr>
                    <td><?= $this->Number->format($zip->id) ?></td>
                    <td>
                        <?= $zip->has('country') ? $this->Html->link($zip->country->name, ['controller' => 'Countries', 'action' => 'view', $zip->country->id]) : '' ?>
                    </td>
                    <td><?= h($zip->zip) ?></td>
                    <td><?= h($zip->name) ?></td>
                    <td><?= $this->Number->format($zip->lat) ?></td>
                    <td><?= $this->Number->format($zip->lng) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $zip->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $zip->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zip->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                <?php
                    echo $this->Paginator->prev('< ' . __('previous'));
                    echo $this->Paginator->numbers();
                    echo $this->Paginator->next(__('next') . ' >');
                ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>