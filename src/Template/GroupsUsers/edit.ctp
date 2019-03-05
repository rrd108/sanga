<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $groupsUser->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupsUser->group_id)]) ?></li>
            <li><?= $this->Html->link(__('List Groups Users'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="groupsUsers form large-10 medium-9 columns">
        <?= $this->Form->create($groupsUser) ?>
            <fieldset>
                <legend><?= __('Edit Groups User') ?></legend>
            <?php
                echo $this->Form->input('id');
                echo $this->Form->input('intersection_group_id', ['options' => $groups]);
            ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
