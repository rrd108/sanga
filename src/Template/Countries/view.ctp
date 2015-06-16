<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
<div class="countries view large-10 medium-9 columns">
    <h2><?= h($country->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($country->name) ?></p>
        </div>
        <div class="large-2 large-offset-1 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($country->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Zips') ?></h4>
    <?php if (!empty($country->zips)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Country Id') ?></th>
            <th><?= __('Zip') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Lat') ?></th>
            <th><?= __('Lng') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($country->zips as $zips): ?>
        <tr>
            <td><?= h($zips->id) ?></td>
            <td><?= h($zips->country_id) ?></td>
            <td><?= h($zips->zip) ?></td>
            <td><?= h($zips->name) ?></td>
            <td><?= h($zips->lat) ?></td>
            <td><?= h($zips->lng) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Zips', 'action' => 'view', $zips->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Zips', 'action' => 'edit', $zips->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Zips', 'action' => 'delete', $zips->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zips->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
</div>
</div>
