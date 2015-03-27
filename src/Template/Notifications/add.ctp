<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></ul>
	</nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper">
	<div class="row">
		<div class="notifications form large-10 medium-9 columns">
		<?= $this->Form->create($notification) ?>
			<fieldset>
				<legend><?= __('Add Notification'); ?></legend>
			<?php
				echo $this->Form->input('user_id', ['options' => $users]);
				echo $this->Form->input('notification');
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
