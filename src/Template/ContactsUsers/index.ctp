<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Contacts User'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsUsers index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('contact_id') ?></th>
                        <th><?= $this->Paginator->sort('user_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactsUsers as $contactsUser) : ?>
                    <tr>
                        <td>
                            <?= $contactsUser->has('contact') ? $this->Html->link($contactsUser->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsUser->contact->id]) : '' ?>
                        </td>
                        <td>
                            <?= $contactsUser->has('user') ? $this->Html->link($contactsUser->user->name, ['controller' => 'Users', 'action' => 'view', $contactsUser->user->id]) : '' ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $contactsUser->contact_id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactsUser->contact_id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsUser->contact_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsUser->contact_id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>