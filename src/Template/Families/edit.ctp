<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete # {0}?', $family->id)]) ?></li>
			<li><?= $this->Html->link(__('List Families'), ['action' => 'index']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="families form large-10 medium-9 columns">
		<?= $this->Form->create($family) ?>
			<fieldset>
				<legend><?= __('Edit Family') ?></legend>
			<?php
			?>
			</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
