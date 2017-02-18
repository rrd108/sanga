<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Usergroup'), ['action' => 'add']) ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="usergroups index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('admin_user') ?></th>
                    <th><?= $this->Paginator->sort('members') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usergroups as $usergroup): ?>
                <tr>
                    <td><?= h($usergroup->name) ?></td>
                    <td>
                        <?php
                        if ($usergroup->admin_user->id == $this->request->session()->read('Auth.User.id')) {
                            print '<span class="tag tag-viewable">' . $usergroup->admin_user->name . '</span>';
                        } else {
                            print $usergroup->admin_user->name;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach ($usergroup->users as $user) {
                                print '<span class="tag ';
                                if ($user->_joinData->joined) {
                                    print 'tag-viewable"';
                                } else {
                                    print 'tag-shared"';
                                }
                                print '>' . $user->name . '</span>';
                            }
                        ?>
                    </td>
                    <td class="actions">
                        <?php if ($usergroup->admin_user->id == $this->request->session()->read('Auth.User.id')) : ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usergroup->id]) ?>
                        <?= $this->Form->postLink(
                                __('Delete'),
                                [
                                    'action' => 'delete',
                                    $usergroup->id
                                ],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $usergroup->id)]
                            ) ?>
                        <?php endif; ?>
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