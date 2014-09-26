<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Zip'), ['action' => 'edit', $zip->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Zip'), ['action' => 'delete', $zip->id], ['confirm' => __('Are you sure you want to delete # %s?', $zip->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="zips view large-10 medium-9 columns">
	<h2><?= h($zip->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= h($zip->id) ?></p>
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($zip->name) ?></p>
		</div>
	</div>
</div>
