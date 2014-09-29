<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Grouptype'), ['action' => 'edit', $grouptype->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Grouptype'), ['action' => 'delete', $grouptype->id], ['confirm' => __('Are you sure you want to delete # %s?', $grouptype->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Grouptypes'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Grouptype'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="grouptypes view large-10 medium-9 columns">
	<h2><?= h($grouptype->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($grouptype->name) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($grouptype->id) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Groups') ?></h4>
	<?php if (!empty($grouptype->groups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Grouptype Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($grouptype->groups as $groups): ?>
		<tr>
			<td><?= h($groups->id) ?></td>
			<td><?= h($groups->name) ?></td>
			<td><?= h($groups->grouptype_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # %s?', $groups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
