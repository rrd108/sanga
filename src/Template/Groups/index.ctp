<?= $this->Html->script('sanga.groups.index.js', ['block' => true]) ?>
<div class="row">
    <div class="groups index column large-12">
        <?php
        echo $this->Form->create($group, ['url' => ['action' => 'add']]);
        ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('admin_user_id') ?></th>
                <th><?= $this->Paginator->sort('shared') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= __('Members') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                echo '<td>';
                if ($this->request->session()->read('Auth.User.id') >= 9) {
                    echo $this->Form->input('admin_user_id',
                        [
                            'label' => false,
                            'options' => $users,
                            'value' => $this->request->session()->read('Auth.User.id')
                        ]);
                } else {
                    echo '<span class="tag tag-mine">' . $this->request->session()->read('Auth.User.name') . '</span>';
                }
                echo '</td>';
                echo '<td>';
                echo $this->Form->input('shared',
                    [
                        'label' => false
                    ]);
                echo '</td>';
                echo '<td>';
                echo $this->Form->input('name', ['label' => false]);
                echo '</td>';
                echo '<td>';
                echo '</td>';
                echo '<td>';
                echo $this->Form->input('description', ['label' => false]);
                echo '</td>';
                //echo $this->Form->input('users._ids', ['options' => $users]);
                //echo $this->Form->input('contacts._ids', ['options' => $contacts]);
                echo '<td>';
                echo $this->Form->button(__('Submit'), ['class' => 'radius']);
                echo '</td>';
                ?>
            </tr>
            <?php foreach ($groups as $group): ?>
                <tr>
                    <td>
                        <?php
                        $css = ($group->admin_user_id == $this->request->session()->read('Auth.User.id')) ? 'mine' : 'viewable';
                        print '<span class="tag tag-' . $css . '">' . $group->admin_user->name . '</span>';
                        ?>
                    </td>
                    <td><?= ($group->shared) ? '✔' : '' ?></td>
                    <td>
                        <?php
                        if ($group->shared) {
                            $css = 'shared';
                        } elseif ($group->admin_user_id == $this->request->session()->read('Auth.User.id')) {
                            $css = 'mine';
                        } else {
                            $css = 'viewable';
                        }
                        echo '<span class="tag tag-' . $css . '">' . $group->name . '</span>';
                        ?>
                    </td>
                    <td><?= count($group->contacts) ?></td>
                    </td>
                    <td><?= h($group->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $group->id]) ?>
                        <?php
                        if ($group->admin_user_id == $this->request->session()->read('Auth.User.id')) {
                            echo $this->Html->link(
                                __('Edit'),
                                ['action' => 'edit', $group->id],
                                ['class' => 'editlink']
                            );
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]);
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div class="paginator">
            <ul class="pagination centered">
                <?php
                echo $this->Paginator->prev('< ' . __('previous'));
                echo $this->Paginator->numbers();
                echo $this->Paginator->next(__('next') . ' >');
                ?>
            </ul>
            <div class="pagination-counter"><?= $this->Paginator->counter() ?></div>
        </div>
    </div>
</div>