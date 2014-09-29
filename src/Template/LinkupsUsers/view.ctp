<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Linkups User'), ['action' => 'edit', $linkupsUser->linkup_id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Linkups User'), ['action' => 'delete', $linkupsUser->linkup_id], ['confirm' => __('Are you sure you want to delete # %s?', $linkupsUser->linkup_id)]) ?> </li>
		<li><?= $this->Html->link(__('List Linkups Users'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkups User'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="linkupsUsers view large-10 medium-9 columns">
	<h2><?= h($linkupsUser->linkup_id) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Role') ?></h6>
			<p><?= h($linkupsUser->role) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Linkup Id') ?></h6>
			<p><?= $this->Number->format($linkupsUser->linkup_id) ?></p>
			<h6 class="subheader"><?= __('User Id') ?></h6>
			<p><?= $this->Number->format($linkupsUser->user_id) ?></p>
		</div>
	</div>
</div>
