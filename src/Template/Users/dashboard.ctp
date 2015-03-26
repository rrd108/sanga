<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="index large-12 columns">
			<h1><?= __('Dashboard') ?></h1>

			<h2 class="cl"><?= $this->Session->read('Auth.User.realname') ?></h2>
			<div class="dashstat">
				<h6><?= $dash['contacts']['own'] ?></h6>
				<p><?= __('Contacts') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['contacts']['newown'] ?></h6>
				<p><?= __('New Contacts this week') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['contacts']['birthdayown'] ?></h6>
				<p><?= __('Birthdays this week') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['histories']['own'] ?></h6>
				<p><?= __('Histories') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['histories']['week'] ?></h6>
				<p><?= __('This week\'s activity') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['histories']['last2weeks'] - $dash['histories']['week'] ?></h6>
				<p><?= __('Last week\'s activity') ?></p>
			</div>

			<h2 class="cl"><?= __('Total') ?></h2>
			<div class="dashstat">
				<h6><?= $dash['contacts']['total'] ?></h6>
				<p><?= __('Contacts') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['contacts']['newtotal'] ?></h6>
				<p><?= __('New Contacts this week') ?></p>
			</div>
			<div class="dashstat">
				<h6><?= $dash['histories']['total'] ?></h6>
				<p><?= __('Histories') ?></p>
			</div>

		</div>
	</div>
</div>
