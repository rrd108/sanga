<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Family'), ['action' => 'edit', $family->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Family'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete # {0}?', $family->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Families'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Family'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="families view large-10 medium-9 columns">
	<h2><?= h($family->id) ?></h2>
	<div class="row">
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($family->id) ?></p>
		</div>
	</div>
</div>
