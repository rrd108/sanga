<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="events form large-10 medium-9 columns">
		<?= $this->Form->create($event) ?>
			<fieldset>
				<legend><?= __('Add Event') ?></legend>
			<?php
				echo $this->Form->input('name');
				echo $this->Form->input('user_id', ['options' => $users, 'empty' => __('-- Choose --')]);
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
