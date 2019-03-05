<?php $this->assign('title', __('Login')); ?>

<div class="column">
    <div class="row align-center">
        <div class="large-6 medium-6 small-10 column" id="loginform">
            <?= $this->Flash->render('auth') ?>
            <div class="row align-center">
                <div class="column large-6">
                    <?php echo $this->Html->image('logo-big.png', ['alt' => 'Sanga logo']) ?>
                </div>
            </div>
            <?php if (!isset($mailsent)) : ?>
            <?= $this->Form->create(
                'Users',
                [
                    'url' => [
                        'controller' => 'Users',
                        'action' => 'login',
                        'redirect' => $this->request->getQuery('redirect')
                    ]
                ]
            ) ?>
            <div class="row">
                <div class="column large-12">
                    <?= $this->Form->control('email', ['autofocus' => 'autofocus']) ?>
                </div>
            </div>
            <div class="row">
                <div class="column large-12">
                    <?= $this->Form->control('password') ?>
                </div>
            </div>
            <div class="row align-center">
                <?= $this->Form->button(__('Login'), ['class' => 'button']); ?>
            </div>
            <div class="row align-center">
                <?= $this->Form->button(
                    __('Password Reminder'),
                    [
                        'name' => 'passreminder',
                        'value' => 'remindme'
                    ]
                ); ?>
            </div>
            <?= $this->Form->end() ?>
            <?php endif; ?>
        </div>
    </div>
</div>