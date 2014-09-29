<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Session'), ['action' => 'edit', $session->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Session'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # %s?', $session->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Session'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="sessions view large-10 medium-9 columns">
	<h2><?= h($session->id) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= h($session->id) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Expires') ?></h6>
			<p><?= $this->Number->format($session->expires) ?></p>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Data') ?></h6>
			<?= $this->Text->autoParagraph(h($session->data)); ?>
		</div>
	</div>
</div>
