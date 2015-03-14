<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?></li>
			<li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="countries form large-10 medium-9 columns">
		<?= $this->Form->create($country) ?>
			<fieldset>
				<legend><?= __('Edit Country') ?></legend>
			<?php
				echo $this->Form->input('name');
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>