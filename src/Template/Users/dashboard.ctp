<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Contacts'), ['controller' => 'Contacts']) ?></li>
            <li><?= $this->Html->link(__('Histories'), ['controller' => 'Histories']) ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="index large-12 columns">
            <h1><?= __('Dashboard') ?></h1>

            <h2 class="cl"><?= $this->request->session()->read('Auth.User.realname') ?></h2>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['contacts']['own'], ['places' => 0]) ?></h6>
                <p><?= __('Contacts') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['contacts']['newown'], ['places' => 0]) ?></h6>
                <p><?= __('New Contacts this week') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['contacts']['birthdayown'], ['places' => 0]) ?></h6>
                <p><?= __('Birthdays this week') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['histories']['own'], ['places' => 0]) ?></h6>
                <p><?= __('Histories') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['histories']['week'], ['places' => 0]) ?></h6>
                <p><?= __('This week\'s activity') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['histories']['last2weeks'], ['places' => 0]) ?></h6>
                <p><?= __('Last week\'s activity') ?></p>
            </div>

            <?php if ($dash['usergroups']->count()) : ?>
                <h2 class="cl"><?= __('Last week activity in your user groups') ?></h2>
                <?php foreach ($dash['usergroups'] as $userInGroups) : ?>
                    <div class="dashstat">
                        <h6><?= $this->Number->format(count($userInGroups->histories)) ?></h6>
                        <p><?= h($userInGroups->name) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <h2 class="cl"><?= __('Total') ?></h2>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['contacts']['total'], ['places' => 0]) ?></h6>
                <p><?= __('Contacts') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['contacts']['newtotal'], ['places' => 0]) ?></h6>
                <p><?= __('New Contacts this week') ?></p>
            </div>
            <div class="dashstat">
                <h6><?= $this->Number->format($dash['histories']['total'], ['places' => 0]) ?></h6>
                <p><?= __('Histories') ?></p>
            </div>

        </div>
    </div>
</div>
