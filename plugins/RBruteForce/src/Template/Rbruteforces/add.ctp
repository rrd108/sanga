<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Rbruteforces'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="rbruteforces form large-10 medium-9 columns">
<?= $this->Form->create($rbruteforce) ?>
	<fieldset>
		<legend><?= __('Add Rbruteforce') ?></legend>
	<?php
		echo $this->Form->input('ip');
		echo $this->Form->input('url');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
