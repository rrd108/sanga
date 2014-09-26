<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Eventgroups'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="eventgroups form large-10 medium-9 columns">
<?= $this->Form->create($eventgroup) ?>
	<fieldset>
		<legend><?= __('Add Eventgroup'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
