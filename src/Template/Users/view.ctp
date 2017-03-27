<?php
print $this->Html->script('sanga.users.view.js', ['block' => true]);
?>
<div class="row">
    <div class="large-10 medium-9 columns">
    <div class="user-details-view">
        <div class="main-title row">
            <div class="column large-12">
                <h2><?= h($user->name) ?></h2>
            </div>
        </div><!-- row -->
        <div class="row">
            <!--div class="user-profile-image column large-3">
                <img src="http://cdn.livestream.com/website/ba23e87/assets/thumbnails/profile.png" alt="">
            </div-->
            <div class="user-profile-details column large-6">
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Name') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="ed">
                            <span class="dta"><?= h($user->name) ?></span>
                        </p>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Realname') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="ed">
                            <span class="dta"><?= h($user->realname) ?></span>
                        </p>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Email') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="ed">
                            <span class="dta"><?= h($user->email) ?></span>
                        </p>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Phone') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="ed">
                            <span class="dta"><?= h($user->phone) ?></span>
                        </p>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Responsible') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="ed">
                            <span class="dta"><?= h($user->responsible) ?></span>
                        </p>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Role') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="value"><?= $this->Number->format($user->role) ?></p>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="column large-6 panel">
                        <p class="label"><?= __('Active') ?></p>
                    </div>
                    <div class="column large-6 panel">
                        <p class="value"><?= $user->active ? __('Yes') : __('No'); ?></p>
                    </div>
                </div><!-- row -->
            </div>
            <!-- user profile details -->
        </div><!-- row -->
    </div>
    <!-- user detaisl view -->

        <div class="user-details-view">
            <div class="row">
                <div class="column large-12">
                    <h4 class="subheader"><?= __('Groups') ?></h4>
                    <?php if (!empty($user->admin_groups)): ?>
                        <dl id="groups">
                        <?php foreach ($user->admin_groups as $groups): ?>
                            <?php
                            print '<dt>';
                                print h($groups->name);
                                print ' (' . count($groups->contacts) . ') ';
                                print $this->Html->link(
                                    '➤',
                                    [
                                        'controller' => 'groups',
                                        'action' => 'view', $groups->id
                                    ],
                                    ['id' => 'l' . $groups->id]
                                );
                            print '</dt>';
                            print '<dd>';
                                print h($groups->description);
                                print '<br>';
                                print '<span id="gl' . $groups->id . '"">';
                                    foreach ($groups->contacts as $contact) {
                                        print $contact->contactname ? $contact->contactname : $contact->legalname;
                                        print ', ';
                                    }
                                print '</span>';
                            print '</dd>';
                            ?>
                        <?php endforeach; ?>
                        </dl>
                    <?php endif; ?>
                </div><!-- column -->
            </div><!-- row -->
        </div>
        <div class="user-details-view">
            <div class="row">
                <div class="column large-12">
                    <h4 class="subheader"><?= __('Usergroups') ?></h4>
                    <?php if (!empty($user->usergroups)): ?>
                    <dl>
                    <?php foreach ($user->usergroups as $usergroups): ?>
                            <?= '<dt>' . h($usergroups->name) . '</dt>' ?>
                        <?php endforeach; ?>
                    </dl>
                    <?php endif; ?>
                </div><!-- column -->
            </div><!-- row -->
        </div>
    <!-- user detaisl view -->
    </div>
</div>
<!-- row -->
