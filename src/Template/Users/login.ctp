<div class="main-login">
    <div class="row">
    <div class="users form large-4 medium-6 small-10 small-centered column" id="loginform">
        <?php $this->assign('title',  __('Login')); ?>
        <?= $this->Flash->render('auth') ?>
        <div class="row">
            <div class="main-login-logo column large-6 small-centered">
                <?php echo $this->Html->image('logo-big.png', ['alt' => 'Sanga logo']) ?>
            </div>
        </div>
        <?php if ( ! isset($mailsent)) : ?>
        <?= $this->Form->create('Users', ['url' => ['action' => 'login?redirect=' . $this->request->getQuery('redirect')]]) ?>
        <div class="row">
            <div class="column large-12">
                <?= $this->Form->input('email', ['autofocus' => 'autofocus']) ?>
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
                <?= $this->Form->button(
                    __('Password Reminder'),
                    [
                        'class' => 'radius',
                        'name' => 'passreminder'
                    ]
                ); ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
        <?php endif; ?>
        </div>
    </div>
</div>
