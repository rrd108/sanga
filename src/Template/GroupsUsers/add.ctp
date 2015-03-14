<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('List Groups Users'), ['action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="groupsUsers form large-10 medium-9 columns">
		<?= $this->Form->create($groupsUser) ?>
			<fieldset>
				<legend><?= __('Add Groups User') ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('intersection_group_id', ['options' => $groups]);
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>