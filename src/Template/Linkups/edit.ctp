<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $linkup->id], ['confirm' => __('Are you sure you want to delete # %s?', $linkup->id)]) ?></li>
		<li><?= $this->Html->link(__('List Linkups'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="linkups form large-10 medium-9 columns">
<?= $this->Form->create($linkup) ?>
	<fieldset>
		<legend><?= __('Edit Linkup'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
