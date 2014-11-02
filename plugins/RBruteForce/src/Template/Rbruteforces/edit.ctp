<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rbruteforce->expire], ['confirm' => __('Are you sure you want to delete # {0}?', $rbruteforce->expire)]) ?></li>
		<li><?= $this->Html->link(__('List Rbruteforces'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="rbruteforces form large-10 medium-9 columns">
<?= $this->Form->create($rbruteforce) ?>
	<fieldset>
		<legend><?= __('Edit Rbruteforce') ?></legend>
	<?php
		echo $this->Form->input('ip');
		echo $this->Form->input('url');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
