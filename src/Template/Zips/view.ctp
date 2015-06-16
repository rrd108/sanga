<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Zip'), ['action' => 'edit', $zip->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Zip'), ['action' => 'delete', $zip->id], ['confirm' => __('Are you sure you want to delete # %s?', $zip->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Zip'), ['action' => 'add']) ?> </li>
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
        <div class="zips view large-10 medium-9 columns">
            <h2><?= h($zip->zip) ?></h2>
            <div class="row">
                <div class="large-5 columns strings">
                    <h6 class="subheader"><?= __('Country') ?></h6>
                    <p><?= $zip->has('country') ? $this->Html->link($zip->country->name, ['controller' => 'Countries', 'action' => 'view', $zip->country->id]) : '' ?></p>
                    <h6 class="subheader"><?= __('Zip') ?></h6>
                    <p><?= h($zip->zip) ?></p>
                    <h6 class="subheader"><?= __('Name') ?></h6>
                    <p><?= h($zip->name) ?></p>
                </div>
                <div class="large-2 large-offset-1 columns numbers end">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($zip->id) ?></p>
                    <h6 class="subheader"><?= __('Lat') ?></h6>
                    <p><?= $this->Number->format($zip->lat) ?></p>
                    <h6 class="subheader"><?= __('Lng') ?></h6>
                    <p><?= $this->Number->format($zip->lng) ?></p>
                </div>
            </div>
        </div>
        <div class="related row">
            <div class="column large-12">
            <h4 class="subheader"><?= __('Related Contacts') ?></h4>
            <?php if (!empty($zip->contacts)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Contactname') ?></th>
                    <th><?= __('Legalname') ?></th>
                    <th><?= __('Zip Id') ?></th>
                    <th><?= __('Address') ?></th>
                    <th><?= __('Lat') ?></th>
                    <th><?= __('Lng') ?></th>
                    <th><?= __('Phone') ?></th>
                    <th><?= __('Email') ?></th>
                    <th><?= __('Birth') ?></th>
                    <th><?= __('Active') ?></th>
                    <th><?= __('Comment') ?></th>
                    <th><?= __('Created') ?></th>
                    <th><?= __('Modified') ?></th>
                    <th><?= __('Contactsource Id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($zip->contacts as $contacts): ?>
                <tr>
                    <td><?= h($contacts->id) ?></td>
                    <td><?= h($contacts->contactname) ?></td>
                    <td><?= h($contacts->legalname) ?></td>
                    <td><?= h($contacts->zip_id) ?></td>
                    <td><?= h($contacts->address) ?></td>
                    <td><?= h($contacts->lat) ?></td>
                    <td><?= h($contacts->lng) ?></td>
                    <td><?= h($contacts->phone) ?></td>
                    <td><?= h($contacts->email) ?></td>
                    <td><?= h($contacts->birth) ?></td>
                    <td><?= h($contacts->active) ?></td>
                    <td><?= h($contacts->comment) ?></td>
                    <td><?= h($contacts->created) ?></td>
                    <td><?= h($contacts->modified) ?></td>
                    <td><?= h($contacts->contactsource_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # %s?', $contacts->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
