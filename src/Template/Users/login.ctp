<div class="main-login">
	<div class="row">
	<div class="users form large-4 medium-6 small-10 small-centered column" id="loginform">
		<?php $this->assign('title', __('Login')); ?>
		<?= $this->Flash->render('auth') ?>
		<div class="row">
			<div class="main-login-logo column large-6 small-centered">
				<?php echo $this->Html->image('logo-big.png', ['alt' => 'Sanga logo']) ?>
			</div>
		</div>
		<?= $this->Form->create() ?>
		<div class="row">
			<div class="column large-12">
				<?= $this->Form->input('name', ['autofocus' => 'autofocus']) ?>
			</div>
		</div>
		<div class="row">
			<div class="column large-12">
				<?= $this->Form->input('password') ?>	
			</div>
		</div>
		<div class="row">
			<div class="column large-12">
				<?= $this->Form->button(__('Login'), ['class' => 'radius']); ?>	
			</div>
		</div>
			
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>