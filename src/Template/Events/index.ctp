<div class="row">
    <div class="events index large-12 columns">
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
</div>