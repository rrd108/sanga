<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zip->id], ['confirm' => __('Are you sure you want to delete # %s?', $zip->id)]) ?></li>
			<li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="zips form large-10 medium-9 columns">
		<?= $this->Form->create($zip) ?>
			<fieldset>
				<legend><?= __('Edit Zip'); ?></legend>
			<?php
				echo $this->Form->input('country_id', ['options' => $countries]);
				echo $this->Form->input('zip');
				echo $this->Form->input('name');
				echo $this->Form->input('lat');
				echo $this->Form->input('lng');
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
