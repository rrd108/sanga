<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # %s?', $country->id)]) ?></li>
		<li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="countries form large-10 medium-9 columns">
<?= $this->Form->create($country) ?>
	<fieldset>
		<legend><?= __('Edit Country'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
