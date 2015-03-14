<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # %s?', $notification->id)]) ?></li>
			<li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper">
	<div class="row">
		<div class="notifications form large-10 medium-9 columns">
		<?= $this->Form->create($notification) ?>
			<fieldset>
				<legend><?= __('Edit Notification'); ?></legend>
			<?php
				echo $this->Form->input('user_id', ['options' => $users]);
				echo $this->Form->input('notification');
				echo $this->Form->input('unread');
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
