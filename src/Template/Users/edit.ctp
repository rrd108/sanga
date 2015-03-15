<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
			<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Usergroups'), ['controller' => 'Usergroups', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Usergroup'), ['controller' => 'Usergroups', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->



<div class="content-wrapper">
	<div class="row">
	<div class="users edit-view large-9 medium-10 column">
		<div class="user-main-view">
			<div class="row">
				<div class="column large-12">
					<h2><?= __('Edit User') ?></h2>
				</div>
			</div>
			<?= $this->Form->create($user) ?>
				<?php
					echo '<div class="row">';
						echo $this->Form->input('name', 
							['templates' =>
							['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius', 
							'label' => __('Név')]);
						echo $this->Form->input('realname',
							['templates' =>
							['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Teljes név')]);
					echo '</div>';
					
					echo '<div class="row">';
						echo $this->Form->input('email',
							['templates' =>
							['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Email')]);
						echo $this->Form->input('password',
							['templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Jelszó')]);
					echo '</div>';

					echo '<div class="row">';
						echo $this->Form->input('phone',
							['templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Telefone')]);
					echo '</div>';

					echo '<div class="row">';
						echo $this->Form->input('role',
							['templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Szerep')]);
						echo $this->Form->input('active',
							['templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Active')]);
					echo '</div>';
					
					echo '<div class="row">';
						echo $this->Form->input('contacts._ids', ['options' => $contacts,
							'templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Kapcsolatok')]);
						echo $this->Form->input('groups._ids', ['options' => $groups,
							'templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Csoportok')]);
					echo '</div>';

					echo '<div class="row">';
					echo $this->Form->input('usergroups._ids', ['options' => $usergroups,
						'templates' => ['inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>'],
							'class' => 'radius',
							'label' => __('Usergroups')]);
					echo '</div>';
				?>
				<?= $this->Form->button(__('Submit'), ['class' => 'radius']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
	</div>
</div>
