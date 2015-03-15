<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # %s?', $session->id)]) ?></li>
			<li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
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
	</div>
</div>
