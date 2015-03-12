<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="events form large-10 medium-9 columns">
<?= $this->Form->create($event) ?>
	<fieldset>
		<legend><?= __('Add Event') ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('user_id', ['options' => $users, 'empty' => __('-- Choose --')]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
