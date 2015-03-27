<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?></li>
			<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="events form large-4 medium-8 columns">
		<h2><?= __('Edit Event') ?></h2>
		<?= $this->Form->create($event) ?>
			<?php
				echo '<div class="row"><div class="column large-12">';
				echo $this->Form->input('name');
				echo '</div></div>';

				echo '<div class="row"><div class="column large-12">';
				echo $this->Form->input('user_id', ['options' => $users]);
				echo '</div></div>';

			?>
			<div class="row">
				<div class="column large-12">			
					<?= $this->Form->button(__('Submit'), ['class' => 'radius' ]) ?>
				</div>
			</div>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
