<?php
echo $this->Html->css('daterangepicker.css', ['block' => true]);

echo $this->Html->script('sanga.add.history.entry.js', ['block' => true]);
echo $this->Html->script('sanga.histories.index.js', ['block' => true]);
echo $this->Html->script('sanga.get.history.detail.js', ['block' => true]);

echo $this->Html->script('moment.min.js', ['block' => true]);
echo $this->Html->script('jquery.daterangepicker.js', ['block' => true]);
?>
<div class="row">
    <div class="column large-12">
        <?php
        echo $this->element('ajax-images');
        ?>
        <div class="histories index columns">
            <table id="hTable" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <?php
                    echo $this->Form->create(
                        null,
                        [
                            'id' => 'fForm',
                            'url' => [
                                'controller' => 'Histories',
                                'action' => 'index'
                            ]
                         ]
                    );
                    ?>
                    <td>
                        <?php
                        echo $this->Form->input('fcontact_id', ['type' => 'hidden', 'value' => false]);
                        echo $this->Form->input('xfcontact_id', ['type' => 'text', 'value' => false, 'label' => false]);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('daterange',
                                                    ['label' => false, 'value' => false]);
                        ?>
        
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('fuser_id', ['type' => 'hidden', 'value' => false]);
                        echo $this->Form->input('xfuser_id', ['type' => 'text', 'value' => false, 'label' => false]);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('fgroup_id', ['type' => 'hidden', 'value' => false]);
                        echo $this->Form->input('xfgroup_id', ['label' => false, 'value' => false, 'type' => 'text']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('fevent_id', ['type' => 'hidden', 'value' => false]);
                        echo $this->Form->input('xfevent_id', ['label' => false, 'value' => false, 'type' => 'text']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('fdetail', ['label' => false, 'value' => false]);
                        ?>
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <?= $this->Form->button('↺', ['title' => __('Filter'), 'class' => 'radius']) ?>
                    </td>
                    <?php
                    echo $this->Form->end();
                    ?>
                </tr>
                <tr>
                    <th><?= $this->Paginator->sort('contact_id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('group_id') ?></th>
                    <th><?= $this->Paginator->sort('event_id') ?></th>
                    <th><?= $this->Paginator->sort('short_detail') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>

                <?= $this->element('history-add-form') ?>

                <?php foreach ($histories as $history): ?>
                    <tr>
                        <td>
                            <?php
                            $cName = $history->contact->contactname;
                            if ($history->contact->legalname) {
                                $cName .= '<span class="legalname">' . $history->contact->legalname . '</span>';
                            }
                            echo $history->has('contact') ?
                                    $this->Html->link($cName,
                                                      [
                                                       'controller' => 'Contacts',
                                                       'action' => 'view',
                                                       $history->contact->id
                                                       ],
                                                       ['escape' => false]
                                                      )
                                    : '';
                            ?>
                        </td>
                        <td><?= $history->date ?></td>
                        <td>
                            <?= $history->has('user') ? $history->user->name : '' ?>
                        </td>
                        <td>
                            <?= $history->has('group') ? $history->group->name : '' ?>
                        </td>
                        <td>
                            <?= $history->has('event') ? $history->event->name : '' ?>
                        </td>
                        <td class="_hd" data-h-id="<?= $history->id ?>"><?= h($history->short_detail) ?></td>
                        <td><?= h($history->quantity) ?></td>
                        <td class="actions">
                            <?php
                                //csak akkor szerkeszthető az esemény, ha nem system eseményről van szó
                                if ( $history->event->id != 1)
                                {
                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $history->id]);
                                }
                            ?>
                        </td>
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
                <div class="pagination-counter"><?= $this->Paginator->counter() ?></div>
            </div>
        </div>
    </div>
</div>
