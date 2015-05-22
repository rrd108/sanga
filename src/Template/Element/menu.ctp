<div class="main-logo">
	<?php echo $this->Html->image('logo-main-big.png', ['alt' => 'Sanga logo', 'url' => '/']); ?>
</div>

	<nav class="primary">
		<ul class="sf-menu">
			<?php
			if($this->request->session()->read('Auth.User.id')):
				if($this->request->session()->read('Auth.User.role') == 10):
			?>
				<li>
					Admin
					<ul>
						<?php
							print '<li>' . $this->Html->link('❶ ' . __('Zips'), ['prefix' => false, 'controller' => 'Zips']) . '</li>';
							print '<li>' . $this->Html->link('☢ ' . __('Countries'), ['prefix' => false, 'controller' => 'Countries', 'action' => 'index']) . '</li>';
							print '<li>' . $this->Html->link('❖ ' . __('Units'), ['prefix' => false, 'controller' => 'Units', 'action' => 'index']) . '</li>';
							print '<li>' . $this->Html->link('☻ ' . __('Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</li>';
							print '<li>' . $this->Html->link('⁂ ' . __('Groups'), ['prefix' => 'admin', 'controller' => 'Groups', 'action' => 'index']) . '</li>';
						?>
					</ul>
				</li>
				<?php endif; ?>
			<li>
				CRM
				<ul>
					<?php
						print '<li>'. $this->Html->link('♥ ' . __('Contacts'), ['prefix' => false, 'controller' => 'Contacts', 'action' => 'index']) . '</li>';
						print '<li>'. $this->Html->link('⊕ ' . __('Add Contact'), ['prefix' => false, 'controller' => 'Contacts', 'action' => 'add']) . '</li>';
						print '<li>'. $this->Html->link('⇉ ' . __('Google Contact Import'), ['prefix' => false, 'controller' => 'Contacts', 'action' => 'google']) . '</li>';
						print '<li>'. $this->Html->link('⇉ ' . __('Csv Contact Import'), ['prefix' => false, 'controller' => 'Imports', 'action' => 'index']) . '</li>';
						print '<li>' . $this->Html->link('⚑ ' . __('Histories'), ['prefix' => false, 'controller' => 'Histories', 'action' => 'index']) . '</li>';
						print '<li>' . $this->Html->link('♛ ' . __('Queries'), ['prefix' => false, 'controller' => 'Contacts', 'action' => 'searchquery']) . '</li>';
						print '<li>' . $this->Html->link('✈ ' . __('Map'), ['prefix' => false, 'controller' => 'Contacts', 'action' => 'showmap']) . '</li>';
					?>
				</ul>
			</li>
			<li>
				Törzsadatok
				<ul>
					<?php
						if(in_array($this->request->session()->read('Auth.User.role'), [9,10])){
							print '<li>' . $this->Html->link('⚓ ' . __('Contact sources'), ['prefix' => false, 'controller' => 'Contactsources', 'action' => 'index']) . '</li>';
							print '<li>' . $this->Html->link('✋ ' . __('User groups'), ['prefix' => false, 'controller' => 'Usergroups', 'action' => 'index']) . '</li>';
							print '<li>' . $this->Html->link('✄ ' . __('Skills'), ['prefix' => false, 'controller' => 'Skills', 'action' => 'index']) . '</li>';
						}
						print '<li>' . $this->Html->link('⁂ ' . __('Groups'), ['prefix' => false, 'controller' => 'Groups', 'action' => 'index']) . '</li>';
						print '<li>' . $this->Html->link('✿ ' . __('Events'), ['prefix' => false, 'controller' => 'Events', 'action' => 'index']) . '</li>';
					?>
				</ul>
			</li>
			<li>
				
				<?php
					print $this->request->session()->read('Auth.User.realname');
					$nc = '';
					if($notification_count)
						print $nc = ' <span class="notice">'.$notification_count.'</span>';
				?>
				<ul>
					<?php
						print '<li>' . $this->Html->link('☭ ' . __('Profile'), ['prefix' => false, 'controller' => 'Users', 'action' => 'view']) . '</li>';
						print '<li>' . $this->Html->link('⚠ ' . __('Notifications') . $nc, ['prefix' => false, 'controller' => 'Notifications', 'action' => 'index'], ['escapeTitle' => false]) . '</li>';
						print '<li>' . $this->Html->link('⊗ ' . __('Logout'), ['prefix' => false, 'controller' => 'Users', 'action' => 'logout']) . '</li>';
					?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</nav>

		<?php
		if($this->request->session()->read('Auth.User.id')):
		?>
		<div class="header-search">
			<?php
				print $this->Form->create(null, ['id' => 'qForm',
												 'url' => ['prefix' => false, 'controller' => 'Search', 'action' => 'quicksearch']]);
				print $this->Form->input('quickterm',
										 ['label' => false,
										  'placeholder' => __('Search')]);
				print $this->Form->end();

			endif;?>
		</div>
</div>

