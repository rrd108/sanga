<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
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
				<legend><?= __('Add Session'); ?></legend>
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