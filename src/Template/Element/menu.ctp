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
					print '<li>' . $this->Html->link('❶ ' . __('Zips'), '/zips') . '</li>';
					print '<li>' . $this->Html->link('☢ ' . __('Countries'), '/countries') . '</li>';
					print '<li>' . $this->Html->link('❖ ' . __('Units'), '/units') . '</li>';
					//print '<li>' . $this->Html->link('☻ ' . __('Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</li>';
					print '<li>' . $this->Html->link('☻ ' . __('Users'), ['controller' => 'Users', 'action' => 'index']) . '</li>';
				?>
			</ul>
		</li>
		<?php endif; ?>
		<?php if(in_array($this->Session->read('Auth.User.role'), [9,10])): ?>
		<li>
			⚙ Törzsadatok
			<ul>
				<?php
					print '<li>' . $this->Html->link('⚓ ' . __('Contact sources'), '/contactsources') . '</li>';
					print '<li>' . $this->Html->link('⁂ ' . __('Groups'), '/groups') . '</li>';
					print '<li>' . $this->Html->link('✿ ' . __('Events'), '/events') . '</li>';
					print '<li>' . $this->Html->link('✋ ' . __('User groups'), '/usergroups') . '</li>';
					print '<li>' . $this->Html->link('✄ ' . __('Skills'), '/skills') . '</li>';
				?>
			</ul>
		</li>
		<?php endif; ?>
		<li>
			✽ CRM
			<ul>
				<?php
					print '<li>'. $this->Html->link('♥ ' . __('Contacts'), '/contacts') . '</li>';
					print '<li>'. $this->Html->link('⊕ ' . __('Add Contact'), '/contacts/add') . '</li>';
					print '<li>' . $this->Html->link('⚑ ' . __('Histories'), '/histories') . '</li>';
					print '<li>' . $this->Html->link('♛ ' . __('Queries'), '/contacts/search') . '</li>';
					print '<li>' . $this->Html->link('✈ ' . __('Map'), '/contacts/showmap') . '</li>';
				?>
			</ul>
		</li>
		<li>
			★ Adataim
			<?php
				$nc = '';
				if($notification_count)
					print $nc = '<span class="notice">'.$notification_count.'</span>';
			?>
			<ul>
				<?php
					print '<li>' . $this->Html->link('☭ ' . __('Profile'), '/users/view') . '</li>';
					print '<li>' . $this->Html->link('⚠ ' . __('Notifications') . ' ' . $nc, '/notifications', ['escapeTitle' => false]) . '</li>';
					print '<li>' . $this->Html->link('⊗ ' . _('Logout'), '/users/logout') . '</li>';
				?>
			</ul>
		</li>
		<li>
			<?php
				print $this->Form->create('contacts', ['action' => 'view']);
				print $this->Form->autocomplete('name', [
														'select' => true,
														'source' => '/contacts/searchname'
														]);
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