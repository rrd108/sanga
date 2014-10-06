<?php $this->assign('title', __('Log in')); ?>
<div class="users form" id="loginform">
<?= $this->Flash->render('auth') ?>
<?php
	echo $this->Html->image('logo-big.png', ['alt' => 'Sanga logo'])
?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend>Bejelentkezés</legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>