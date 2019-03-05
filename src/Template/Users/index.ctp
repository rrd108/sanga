<div class="row">
    <div class="users index large-12 column">
        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('realname') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('phone') ?></th>
                <th><?= $this->Paginator->sort('responsible') ?></th>
                <th><?= $this->Paginator->sort('contacts') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->realname) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->phone) ?></td>
                <td>
                    <?php
                    if ($user->responsible) {
                        $responsibilities = explode(', ', $user->responsible);
                        foreach ($responsibilities as $resp) {
                            print '<span class="label viewable">' . h($resp) . '</span>';
                        }
                    }
                    ?>
                </td>
                <td class="r"><?= $this->Number->format(h(count($user->contacts))) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination centered">
            <?php
                echo $this->Paginator->prev('< ' . __('previous'));
                echo $this->Paginator->numbers();
                echo $this->Paginator->next(__('next') . ' >');
            ?>
            </ul>
            <div class="pagination-counter"><?= $this->Paginator->counter() ?></p></div>
        </div>
    </div>
</div>