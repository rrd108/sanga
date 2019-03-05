<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Contactsource'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsources index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactsources as $contactsource) : ?>
                    <tr>
                        <td><?= $this->Number->format($contactsource->id) ?></td>
                        <td><?= h($contactsource->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $contactsource->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactsource->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsource->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>