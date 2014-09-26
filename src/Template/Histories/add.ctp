<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="histories form large-10 medium-9 columns">
<?= $this->Form->create($history) ?>
	<fieldset>
		<legend><?= __('Add History'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('detail');
		echo $this->Form->input('amount');
		echo $this->Form->input('groups_id');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
