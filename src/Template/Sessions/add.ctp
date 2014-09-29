<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="sessions form large-10 medium-9 columns">
<?= $this->Form->create($session) ?>
	<fieldset>
		<legend><?= __('Add Session'); ?></legend>
	<?php
		echo $this->Form->input('data');
		echo $this->Form->input('expires');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
