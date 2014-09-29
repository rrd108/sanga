<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # %s?', $group->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Grouptypes'), ['controller' => 'Grouptypes', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Grouptype'), ['controller' => 'Grouptypes', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="groups view large-10 medium-9 columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($group->name) ?></p>
			<h6 class="subheader"><?= __('Grouptype') ?></h6>
			<p><?= $group->has('grouptype') ? $this->Html->link($group->grouptype->name, ['controller' => 'Grouptypes', 'action' => 'view', $group->grouptype->id]) : '' ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($group->id) ?></p>
		</div>
	</div>
</div>
