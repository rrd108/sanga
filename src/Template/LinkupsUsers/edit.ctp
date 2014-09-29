<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $linkupsUser->linkup_id], ['confirm' => __('Are you sure you want to delete # %s?', $linkupsUser->linkup_id)]) ?></li>
		<li><?= $this->Html->link(__('List Linkups Users'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="linkupsUsers form large-10 medium-9 columns">
<?= $this->Form->create($linkupsUser) ?>
	<fieldset>
		<legend><?= __('Edit Linkups User'); ?></legend>
	<?php
		echo $this->Form->input('role');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
