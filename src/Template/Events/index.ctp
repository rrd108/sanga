<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>


<div class="content-wrapper large-10 medium-10 small-12 columns">
    <?php
    echo $this->Form->create($event, ['url' => ['action' => 'add']]);
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                echo '<td>';
                echo $this->Form->input('name', ['label' => false]);
                echo '</td>';
                echo '<td>';
                if ($this->request->session()->read('Auth.User.id') >= 9) {
                    echo $this->Form->input(
                        'admin_user_id',
                        [
                            'label' => false,
                            'options' => $users,
                            'value' => $this->request->session()->read('Auth.User.id')
                        ]
                    );
                } else {
                    echo '<span class="label mine">' . $this->request->session()->read('Auth.User.name') . '</span>';
                }
                echo '</td>';
                echo '<td>';
                echo $this->Form->button(__('Submit'), ['class' => 'button']);
                echo '</td>';
                ?>
            </tr>

            <?php foreach ($events as $event) : ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td>
                    <?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id], ['class' => 'label']) : '' ?>
                </td>
                <td class="actions">
                    <?php
                    if ($event->user_id == $this->request->session()->read('Auth.User.id')) {
                        echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]);
                    }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('paginator') ?>
</div>