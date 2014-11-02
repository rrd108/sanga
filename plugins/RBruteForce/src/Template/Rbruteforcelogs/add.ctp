<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Rbruteforcelogs'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="rbruteforcelogs form large-10 medium-9 columns">
<?= $this->Form->create($rbruteforcelog) ?>
	<fieldset>
		<legend><?= __('Add Rbruteforcelog') ?></legend>
	<?php
		echo $this->Form->input('data');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
