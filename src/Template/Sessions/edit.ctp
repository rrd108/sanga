<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # %s?', $session->id)]) ?></li>
		<li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="sessions form large-10 medium-9 columns">
<?= $this->Form->create($session) ?>
	<fieldset>
		<legend><?= __('Edit Session'); ?></legend>
	<?php
		echo $this->Form->input('data');
		echo $this->Form->input('expires');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
