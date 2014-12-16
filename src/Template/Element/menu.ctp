<?php echo $this->Html->image('logo-small.png',
							  ['alt' => 'Sanga logo',
							   'url' => '/']); ?>
<div class="header-title">
	<?php
	if($this->Session->read('Auth.User.id')):
	?>
	<ul class="sf-menu">
		<?php if($this->Session->read('Auth.User.role') == 10): ?>
		<li>
			☠ Admin
			<ul>
				<?php
					print '<li>' . $this->Html->link('❶ ' . __('Zips'), ['controller' => 'Zips']) . '</li>';
					print '<li>' . $this->Html->link('☢ ' . __('Countries'), ['controller' => 'Countries', 'action' => 'index']) . '</li>';
					print '<li>' . $this->Html->link('❖ ' . __('Units'), ['controller' => 'Units', 'action' => 'index']) . '</li>';
					//print '<li>' . $this->Html->link('☻ ' . __('Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</li>';
					print '<li>' . $this->Html->link('☻ ' . __('Users'), ['controller' => 'Users', 'action' => 'index']) . '</li>';
				?>
			</ul>
		</li>
		<?php endif; ?>
		<li>
			⚙ Törzsadatok
			<ul>
				<?php
					if(in_array($this->Session->read('Auth.User.role'), [9,10])){
						print '<li>' . $this->Html->link('⚓ ' . __('Contact sources'), ['controller' => 'Contactsources', 'action' => 'index']) . '</li>';
						print '<li>' . $this->Html->link('✋ ' . __('User groups'), ['controller' => 'Usergroups', 'action' => 'index']) . '</li>';
						print '<li>' . $this->Html->link('✄ ' . __('Skills'), ['controller' => 'Skills', 'action' => 'index']) . '</li>';
					}
					print '<li>' . $this->Html->link('⁂ ' . __('Groups'), ['controller' => 'Groups', 'action' => 'index']) . '</li>';
					print '<li>' . $this->Html->link('✿ ' . __('Events'), ['controller' => 'Events', 'action' => 'index']) . '</li>';
				?>
			</ul>
		</li>
		<li>
			✽ CRM
			<ul>
				<?php
					print '<li>'. $this->Html->link('♥ ' . __('Contacts'), ['controller' => 'Contacts', 'action' => 'index']) . '</li>';
					print '<li>'. $this->Html->link('⊕ ' . __('Add Contact'), ['controller' => 'Contacts', 'action' => 'add']) . '</li>';
					print '<li>' . $this->Html->link('⚑ ' . __('Histories'), ['controller' => 'Histories', 'action' => 'index']) . '</li>';
					print '<li>' . $this->Html->link('♛ ' . __('Queries'), ['controller' => 'Contacts', 'action' => 'search']) . '</li>';
					print '<li>' . $this->Html->link('✈ ' . __('Map'), ['controller' => 'Contacts', 'action' => 'showmap']) . '</li>';
				?>
			</ul>
		</li>
		<li>
			★ 
			<?php
				print $this->Session->read('Auth.User.realname');
				$nc = '';
				if($notification_count)
					print $nc = ' <span class="notice">'.$notification_count.'</span>';
			?>
			<ul>
				<?php
					print '<li>' . $this->Html->link('☭ ' . __('Profile'), ['controller' => 'Users', 'action' => 'view']) . '</li>';
					print '<li>' . $this->Html->link('⚠ ' . __('Notifications') . $nc, ['controller' => 'Notifications', 'action' => 'index'], ['escapeTitle' => false]) . '</li>';
					print '<li>' . $this->Html->link('⊗ ' . _('Logout'), ['controller' => 'Users', 'action' => 'logout']) . '</li>';
				?>
			</ul>
		</li>
		<li>
			<?php
				print $this->Form->create('contacts', ['action' => 'view']);
				print $this->Form->input('name');
				print $this->Form->end();
			?>
		</li>
	</ul>
	<?php
	endif;
	?>
</div>
<div class="header-help">
	<span>&nbsp;<?php echo $this->Html->getCrumbs(' / ', ''); ?></span>
</div>