<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit Family'), ['action' => 'edit', $family->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Family'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete # {0}?', $family->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Families'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Family'), ['action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="families view large-10 medium-9 columns">
            <h2><?= h($family->id) ?></h2>
            <div class="row">
                <div class="large-2 large-offset-1 columns numbers end">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($family->id) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
