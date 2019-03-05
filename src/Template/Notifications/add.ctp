<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></ul>
    </nav>
</div>


<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="notifications form large-10 medium-9 columns">
        <?= $this->Form->create($notification) ?>
            <fieldset>
                <legend><?= __('New Notification'); ?></legend>
            <?php
                echo $this->Form->input('user_id', ['options' => $users, 'label' => __('To')]);
                echo $this->Form->input('notification');
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
