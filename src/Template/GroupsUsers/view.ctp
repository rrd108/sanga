<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('Edit Groups User'), ['action' => 'edit', $groupsUser->group_id]) ?> </li>
			<li><?= $this->Form->postLink(__('Delete Groups User'), ['action' => 'delete', $groupsUser->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupsUser->group_id)]) ?> </li>
			<li><?= $this->Html->link(__('List Groups Users'), ['action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Groups User'), ['action' => 'add']) ?> </li>
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
		<div class="groupsUsers view large-10 medium-9 columns">
			<h2><?= h($groupsUser->group_id) ?></h2>
			<div class="row">
				<div class="large-5 columns strings">
					<h6 class="subheader"><?= __('User') ?></h6>
					<p><?= $groupsUser->has('user') ? $this->Html->link($groupsUser->user->name, ['controller' => 'Users', 'action' => 'view', $groupsUser->user->id]) : '' ?></p>
					<h6 class="subheader"><?= __('Group') ?></h6>
					<p><?= $groupsUser->has('group') ? $this->Html->link($groupsUser->group->name, ['controller' => 'Groups', 'action' => 'view', $groupsUser->group->id]) : '' ?></p>
				</div>
				<div class="large-2 large-offset-1 columns numbers end">
					<h6 class="subheader"><?= __('Id') ?></h6>
					<p><?= $this->Number->format($groupsUser->id) ?></p>
					<h6 class="subheader"><?= __('Group Id') ?></h6>
					<p><?= $this->Number->format($groupsUser->group_id) ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
