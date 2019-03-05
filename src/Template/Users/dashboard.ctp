<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('<i class="fi-heart"></i> ' . __('Contacts')), ['controller' => 'Contacts'], ['escape' => false]) ?></li>
            <li><?= $this->Html->link(__('<i class="fi-flag"></i> ' . __('Histories')), ['controller' => 'Histories'], ['escape' => false]) ?></li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div id="dashboard" class="large-12 small-12 columns">
            <h1><?= __('Dashboard') ?></h1>

            <div class="dashgroup">
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
            </div>

            <?php if ($dash['usergroups']->count()) : ?>
            <div class="dashgroup">
                <h2 class="cl"><?= __('Last week activity in your user groups') ?></h2>
                <?php foreach ($dash['usergroups'] as $userInGroups) : ?>
                <div class="dashstat">
                    <h6><?= $this->Number->format(count($userInGroups->histories)) ?></h6>
                    <p><?= h($userInGroups->name) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="dashgroup">
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