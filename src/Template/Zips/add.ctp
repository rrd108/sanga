<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="zips form large-10 medium-9 columns">
<?= $this->Form->create($zip) ?>
	<fieldset>
		<legend><?= __('Add Zip'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'text'));
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
