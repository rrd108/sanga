<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete # {0}?', $family->id)]) ?></li>
		<li><?= $this->Html->link(__('List Families'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="families form large-10 medium-9 columns">
<?= $this->Form->create($family) ?>
	<fieldset>
		<legend><?= __('Edit Family') ?></legend>
	<?php
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
