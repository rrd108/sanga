<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Linkups Users'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="linkupsUsers form large-10 medium-9 columns">
<?= $this->Form->create($linkupsUser) ?>
	<fieldset>
		<legend><?= __('Add Linkups User'); ?></legend>
	<?php
		echo $this->Form->input('role');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
