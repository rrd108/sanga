<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Rbruteforce'), ['action' => 'edit', $rbruteforce->expire]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Rbruteforce'), ['action' => 'delete', $rbruteforce->expire], ['confirm' => __('Are you sure you want to delete # {0}?', $rbruteforce->expire)]) ?> </li>
		<li><?= $this->Html->link(__('List Rbruteforces'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Rbruteforce'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="rbruteforces view large-10 medium-9 columns">
	<h2><?= h($rbruteforce->expire) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Ip') ?></h6>
			<p><?= h($rbruteforce->ip) ?></p>
			<h6 class="subheader"><?= __('Url') ?></h6>
			<p><?= h($rbruteforce->url) ?></p>
		</div>
		<div class="large-2 columns dates end">
			<h6 class="subheader"><?= __('Expire') ?></h6>
			<p><?= h($rbruteforce->expire) ?></p>
		</div>
	</div>
</div>
