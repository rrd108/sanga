<?php
echo $this->Html->script('jquery.rAutocompleters', ['block' => true]);
echo $this->Html->script('sanga.contacts.view.js', ['block' => true]);
echo $this->Html->script('sanga.contacts.add.js', ['block' => true]);
echo $this->Html->script('sanga.add.history.entry.js', ['block' => true]);
echo $this->Html->script('sanga.get.history.detail.js', ['block' => true]);
?>

<?= $this->Html->link(
    $this->Html->image('edit.png'),
    ['action' => 'edit', $contact->id],
    ['id' => 'editlink', 'class' => 'hidden', 'escape' => false, 'title' => __('Click to edit')]
) ?>

<?= $this->element('ajax-images') ?>

<div id="dialog">
    <h4><?= __('Show system events') ?></h4>
    <?= $this->Form->create($contact, ['id' => 'settingsForm']) ?>
    <?= $this->Form->control(
        'systemevents',
        [
            'type' => 'checkbox',
            'label' => __('Show system events'),
        ]
    ) ?>
    <?= $this->Form->control('sName', ['type' => 'hidden', 'value' => 'Contacts/view/history/system']) ?>
    <?= $this->Form->button(__('Submit'), ['id' => 'submitSettings', 'class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>

<div class="columns">
    <div id="tabs" class="row">
        <div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
            <nav class="side-nav">
                <ul class="side-nav">
                    <li id="tabnav-1"><a href="#tabs-1"><?= __('Personal data') ?></a></li>
                    <li id="tabnav-2"><a href="#tabs-2"><?= __('Family') ?></a></li>
                    <li id="tabnav-3"><a href="#tabs-3"><?= __('Workplace and skills') ?></a></li>
                    <li id="tabnav-4"><a href="#tabs-4"><?= __('Groups') ?></a></li>
                    <li id="tabnav-5"><a href="#tabs-5"><?= __('Histories') ?></a></li>
                    <li id="tabnav-6"><a href="#tabs-6"><?= __('Finances') ?></a></li>
                    <li id="tabnav-7"><a href="#tabs-7"><?= __('Access') ?></a></li>
                    <li id="tabnav-8"><a href="#tabs-8"><?= __('Send a mail') ?></a></li>
                    <li id="tabnav-9"><a href="#tabs-9"><?= __('Documents') ?></a></li>
                </ul>
            </nav>
        </div>

        <div class="content-wrapper large-10 medium-10 small-12 columns">

            <div class="row">
                <h2>
                    <?= h($contact->contactname) ? h($contact->contactname) : h($contact->legalname) ?>
                    <?php if ($contact->google_id) : ?>
                    <?= $this->Html->image('google.png') ?>
                    <?php else : ?>
                    <?= $this->Html->link(
                        $this->Html->image(
                            'google-inactive.png',
                            [
                                'id' => 'gImg',
                                'title' => __('Save to Google Contacts'),
                            ]
                        ),
                        ['action' => 'google_save', $contact->id],
                        ['id' => 'gSave', 'escape' => false]
                    ) ?>
                    <?php endif; ?>
                </h2>
            </div>

            <div class="row">
                <?= $this->Form->create($contact, ['id' => 'editForm', 'url' => ['action' => 'edit']]) ?>
                <div id="tabs-1" class="large-12 medium-12 small-12 columns">
                    <?= $this->Html->link(
                        __('Inactive'),
                        ['action' => 'setinactive', $contact->id, ],
                        [
                            'class' => 'setChange button',
                            'title' => __('Make contact inactive (remove from all lists)'),
                            'confirm' => __('Are you sure you want to delete this contact?'),
                        ]
                    ) ?>
                    <?php if ($contact->profile_image) : ?>
                    <?= $this->Html->image('contacts/' . $contact->id) ?>
                    <?php else : ?>
                    <?= $this->Html->image('contacts/noimg.png') ?>
                    <?php endif ?>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Known name') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">
                                <span class="dta">&nbsp;<?= h($contact->contactname) ?></span>
                                <?= $this->Form->control(
                                    'contactname',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'value' => h($contact->contactname),
                                        'title' => __('Like initiated name, nickname, etc'),
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Legal name') ?></label>
                        </div><!-- column -->
                        <div class="column large-8">
                            <p class="ed">
                                <span class="dta">&nbsp;<?= h($contact->legalname) ?></span>
                                <?= $this->Form->control(
                                    'legalname',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'value' => h($contact->legalname),
                                        'title' => __('Civil name, official legal name, etc'),
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Contact person') ?></label>
                        </div>
                        <div class="column large-8">
                            <p>
                                <span>
                                    <?php if (!empty($contact->users)) : ?>
                                    <?php $myContact = false ?>
                                    <?php foreach ($contact->users as $usr) : ?>
                                    <?php
                                    $css = 'viewable';
                                    if ($usr->id == $this->request->session()->read('Auth.User.id')) {
                                        $myContact = true;
                                        $css = 'mine';
                                    }
                                    ?>
                                    <span class="label <?= $css ?> "><?= h($usr->name) ?></span>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Address') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta zip zip-zip">
                                    <?php if (isset($contact->zip)) : ?>
                                    <?= $contact->zip->zip ?>
                                    <?php endif ?>
                                </span>
                                <span class="dta zip-name">
                                    <?php if (isset($contact->zip)) : ?>
                                    <?= $contact->zip->name ?>
                                    <?php endif; ?>
                                </span>
                                <?= $this->Form->control(
                                    'zip_id',
                                    [
                                        'type' => 'hidden',
                                        'value' => isset($contact->zip) ? $contact->zip->id : false,
                                    ]
                                ) ?>
                                <?= $this->Form->control(
                                    'xzip',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'type' => 'text',
                                        'class' => 'editbox zip',
                                        'label' => false,
                                        'value' => isset($contact->zip) ? $contact->zip->zip . ' ' . $contact->zip->name : '',
                                    ]
                                ) ?>

                                <span class="dta addr address">
                                    <?= h($contact->address) ?>
                                </span>

                                <?= $this->Form->control(
                                    'address',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox addr',
                                        'label' => false,
                                        'value' => $contact->address,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Phone') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta"><?= h($contact->phone) ?></span>
                                <?= $this->Form->control(
                                    'phone',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'value' => $contact->phone,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Email') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta"><?= h($contact->email) ?></span>
                                <?= $this->Form->control(
                                    'email',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'value' => $contact->email,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Birth') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta">
                                    <?= h($contact->birth) ?>
                                </span>
                                <?= $this->Form->control(
                                    'birth',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'type' => 'text',
                                        'class' => 'editbox',
                                        'label' => false,
                                        'value' => $contact->birth ? h($contact->birth) : null,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Sex') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta">
                                    <?php
                                    if ($contact->sex == 1) {
                                        echo __('Male');
                                    } else {
                                        if ($contact->sex == 2) {
                                            echo __('Female');
                                        } else {
                                            echo __('Unknown');
                                        }
                                    }
                                    ?>
                                </span>
                                <?= $this->Form->control(
                                    'sex',
                                    [
                                        'type' => 'radio',
                                        'options' => [1 => __('Male'), 2 => __('Female')],
                                        'templates' => [
                                            'inputContainer' => '{{content}}',
                                            'nestingLabel' => '{{input}}<label {{attrs}} class="editbox">{{text}}</label>',
                                            'radio' => '<input name="{{name}}" type="radio" class="editbox" value="{{value}}" {{attrs}}>',
                                        ],
                                        'label' => false,
                                        'value' => $contact->sex,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Contactsource') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">&nbsp;
                                <span class="dta">
                                    <?= $contact->has('contactsource') ? h($contact->contactsource->name) : '' ?>
                                </span>
                                <?= $this->Form->control(
                                    'contactsource_id',
                                    [
                                        'type' => 'radio',
                                        'options' => $contactsources,
                                        'templates' => [
                                            'inputContainer' => '{{content}}',
                                            'nestingLabel' => '{{input}}<label {{attrs}} class="editbox">{{text}}</label>',
                                            'radio' => '<input name="{{name}}" type="radio" class="editbox" value="{{value}}" {{attrs}}>',
                                        ],
                                        'label' => false,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Active') ?></label>
                        </div>
                        <div class="column large-8">
                            <p class="ed">
                                &nbsp;
                                <span class="dta"><?= $contact->active ? __('Yes') : __('No'); ?></span>
                                <?= $this->Form->control(
                                    'active',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'checked' => $contact->active,
                                        'value' => $contact->active,
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-12">
                            <label><?= __('Comment') ?></label>
                            <p class="ed">&nbsp;
                                <span class="dta">
                                    <?= nl2br(h($contact->comment)); ?>
                                </span>
                                <?= $this->Form->control(
                                    'comment',
                                    [
                                        'templates' => ['inputContainer' => '{{content}}'],
                                        'class' => 'editbox',
                                        'label' => false,
                                        'title' => __('Secondary emails, phones, others'),
                                    ]
                                ) ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column large-4">
                            <label><?= __('Created') ?></label>
                        </div>
                        <div class="column large-8">
                            <p><?= $contact->created ?></p>
                        </div>
                    </div>
                </div>

                <div id="tabs-2" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="column large-9">
                            <div class="row">
                                <div class="large-4 columns strings">
                                    <label><?= __('Family') ?></label>
                                </div>
                                <div class="large-8 columns strings">
                                    <p class="ed">&nbsp;
                                        <?php
                                        //echo $contact->family_id;
                                        ?>
                                        <span class="dta"></span>
                                        <?php
                                        foreach ($family as $familymember) {
                                            if ($familymember->id != $contact->id) {
                                                echo '<span class="label viewable draggable">';
                                                $name = '';
                                                $name .= $familymember->contactname ? $familymember->contactname : '';
                                                $name .= $familymember->legalname ? ' (' . $familymember->legalname . ')' : '';
                                                echo $this->Html->link(
                                                    $name,
                                                    ['action' => 'view', $familymember->id]
                                                );
                                                echo '</span> ';
                                            }
                                        }
                                        ?>
                                        <?php
                                        echo $this->Form->control('family_member_id', ['type' => 'hidden']);
                                        echo $this->Form->control(
                                            'xfamily',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'type' => 'text',
                                                'class' => 'editbox family',
                                                'label' => false,
                                            ]
                                        );
                                        ?>
                                    </p>
                                    <div class="column large-12" id="notfamilymember">
                                        <div class="delete-close"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-3" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="large-9 columns strings">
                            <div class="row">
                                <div class="large-4 column">
                                    <label><?= __('Workplace') ?></label>
                                </div>
                                <div class="large-8 column">
                                    <p class="ed">&nbsp;

                                        <span class="dta"><?= h($contact->workplace) ?></span>
                                        <?php
                                        echo $this->Form->control(
                                            'workplace',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'class' => 'editbox',
                                                'label' => false,
                                                'value' => $contact->workplace,
                                            ]
                                        );
                                        ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column large-4">
                                    <label><?= __('Workplace Address') ?></label>
                                </div>
                                <div class="column large-8">
                                    <p class="ed">&nbsp;
                                        <?php
                                        echo '<span class="dta workplace_zip workplace_zip-zip">';
                                        if (isset($contact->workplace_zip)) {
                                            echo $contact->workplace_zip->zip;
                                        }
                                        echo '</span> ';

                                        echo '<span class="dta workplace_zip-name">';
                                        if (isset($contact->workplace_zip)) {
                                            echo $contact->workplace_zip->name;
                                        }
                                        echo '</span> ';

                                        echo $this->Form->control(
                                            'workplace_zip_id',
                                            [
                                                'type' => 'hidden',
                                                'value' => isset($contact->workplace_zip) ? $contact->workplace_zip->id : false,
                                            ]
                                        );

                                        echo $this->Form->control(
                                            'xworkplace_zip',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'type' => 'text',
                                                'class' => 'editbox zip',
                                                'label' => false,
                                                'value' => isset($contact->workplace_zip) ? $contact->workplace_zip->zip : '',
                                            ]
                                        );

                                        echo '<span class="dta addr workplace_address">';
                                        echo h($contact->workplace_address);
                                        echo '</span>';

                                        echo $this->Form->control(
                                            'workplace_address',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'class' => 'editbox addr',
                                                'label' => false,
                                                'value' => $contact->workplace_address,
                                            ]
                                        );

                                        ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-4 column">
                                    <label><?= __('Workplace Phone') ?></label>
                                </div>
                                <div class="large-8 column">
                                    <p class="ed">&nbsp;

                                        <span class="dta"><?= h($contact->workplace_phone) ?></span>
                                        <?php
                                        echo $this->Form->control(
                                            'workplace_phone',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'class' => 'editbox',
                                                'label' => false,
                                                'value' => $contact->workplace_phone,
                                            ]
                                        );
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-4 column">
                                    <label><?= __('Workplace Email') ?></label>
                                </div>
                                <div class="large-8 column">
                                    <p class="ed">&nbsp;

                                        <span class="dta"><?= h($contact->workplace_email) ?></span>
                                        <?php
                                        echo $this->Form->control(
                                            'workplace_email',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'class' => 'editbox',
                                                'label' => false,
                                                'value' => $contact->workplace_email,
                                            ]
                                        );
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-4 column">
                                    <label><?= __('Skills') ?></label>
                                </div>
                                <div class="large-8 column">
                                    <p class="ed">
                                        <span class="dta">&nbsp;
                                            <?php if (!empty($contact->skills)) : ?>
                                            <?php
                                            foreach ($contact->skills as $skills) :
                                                echo '<span class="label shared removeable" data-id="' . $skills->id . '">';
                                                echo h($skills->name);
                                                echo '</span> ';
                                            endforeach;
                                            ?>
                                            <?php endif; ?>
                                        </span>
                                        <?php
                                        echo $this->Form->control(
                                            'skills',
                                            [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'class' => 'editbox',
                                                'label' => false,
                                                'value' => false,
                                                'type' => 'text',
                                            ]
                                        );
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-4" class="large-12 medium-12 small-12 columns">
                    <h3><?= __('Member') ?></h3>
                    <div class="column large-12" id="member">
                        <?php
                        $cGroups = [];;
                        if (!empty($contact->groups)) :

                            foreach ($contact->groups as $groups) :
                                $myGroup = false;
                                $cGroups[] = $groups->id;
                                if ($groups->admin_user_id == $this->request->session()->read('Auth.User.id')) {
                                    $myGroup = true;
                                }
                                $cssStyle = $groups->shared ? 'shared' : ($myGroup ? 'mine' : 'viewable');

                                $draggable = '';
                                if ($myContact || $myGroup) {
                                    $draggable = 'draggable';
                                }

                                ?>
                        <span class="<?= $draggable ?> member label <?= $cssStyle ?>" data-css="<?= $cssStyle ?>" data-id="<?= $groups->id ?>"><?= h($groups->name) ?></span>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <h3><?= __('Not member') ?></h3>
                    <div class="column large-12" id="notmember">
                        <?php
                        foreach ($accessibleGroups as $group) {
                            if (!in_array($group->id, $cGroups)) {
                                //$cGroups[] = $group->id;
                                $cssStyle = $group->shared ? 'shared' : (($group->admin_user_id == $this->request->session()->read('Auth.User.id')) ? 'mine' : 'viewable');
                                echo "\n" .
                                    '<span class="draggable notmember label default"
                                        data-css="' . $cssStyle . '"
                                        data-id="' . $group->id . '">' .
                                    h($group->name) .
                                    '</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>

            <div id="tabs-5" class="contacts view large-12 columns">
                <div class="row">
                    <div class="column large-12">
                        <?php if (!empty($histories)): ?>
                            <?= $this->Form->create(
                                null,
                                [
                                    'id' => 'hForm',
                                    'url' => [
                                        'controller' => 'Histories',
                                        'action' => 'add',
                                    ],
                                ]) ?>
                            <table id="hTable" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><?= $this->Html->image(
                                                'settings.png',
                                                [
                                                    'id' => 'settings',
                                                    'title' => _('Settings'),
                                                ]
                                            ) ?></th>
                                        <th><?= $this->Paginator->sort('date') ?></th>
                                        <th><?= $this->Paginator->sort('User.name') ?></th>
                                        <th><?= $this->Paginator->sort('Group.name') ?></th>
                                        <th><?= $this->Paginator->sort('Event.name') ?></th>
                                        <th><?= $this->Paginator->sort('short_detail') ?></th>
                                        <th><?= $this->Paginator->sort('quantity') ?></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?= $this->element('history-add-form', ['contactId' => $contact->id]) ?>

                                    <?php foreach ($histories as $history) : ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $history->date; ?></td>
                                        <td>
                                            <?php
                                            if (isset($history->user->name)) {
                                                echo $history->user->name;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($history->group) {
                                                echo $history->group->name;
                                            }
                                            ?>
                                        </td>
                                        <td><?= h($history->event->name) ?></td>
                                        <td class="_hd" data-h-id="<?= $history->id ?>"><?= h($history->short_detail) ?></td>
                                        <td class="r">
                                            <?php
                                            if (isset($history->unit->name) && $history->quantity) {
                                                echo h(
                                                    $this->Number->currency(
                                                        $history->quantity,
                                                        $history->unit->name,
                                                        [
                                                            'places' => 0,
                                                        ]
                                                    )
                                                );
                                            } else {
                                                echo h($history->quantity);
                                            }
                                            ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                            echo $this->Form->end();
                            ?>
                            <?= $this->element('paginator') ?> <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div id="tabs-6" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="column large-12">
                            <table id="hTable" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><?= $this->Paginator->sort('date') ?></th>
                                        <th><?= $this->Paginator->sort('User.name') ?></th>
                                        <th><?= $this->Paginator->sort('Group.name') ?></th>
                                        <th><?= $this->Paginator->sort('Event.name') ?></th>
                                        <th><?= $this->Paginator->sort('detail') ?></th>
                                        <th><?= $this->Paginator->sort('quantity') ?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <?php
                                $total = 0;
                                foreach ($finances as $history) :
                                    ?>
                                <tr>
                                    <td><?php echo $history->date; ?></td>
                                    <td>
                                        <?php
                                        if (isset($history->user->name)) {
                                            echo $history->user->name;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($history->group) {
                                            echo $history->group->name;
                                        }
                                        ?>
                                    </td>
                                    <td><?= h($history->event->name) ?></td>
                                    <td><?= h($history->detail) ?></td>
                                    <td class="r">
                                        <?php
                                        if (isset($history->unit->name) && $history->quantity) {
                                            $total += $history->quantity;
                                            echo h(
                                                $this->Number->currency(
                                                    $history->quantity,
                                                    $history->unit->name,
                                                    [
                                                        'places' => 0,
                                                    ]
                                                )
                                            );
                                        } else {
                                            echo h($history->quantity);
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><?= __('Total') ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="r">
                                            <?php
                                            if (isset($history->unit)) {
                                                echo h(
                                                    $this->Number->currency(
                                                        $total,
                                                        $history->unit->name,
                                                        [
                                                            'places' => 0,
                                                        ]
                                                    )
                                                );
                                            }
                                            ?>
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="tabs-7" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="column large-12">
                            <h3><?= __('Has access as contact persons') ?></h3>
                            <ul>
                                <?php
                                foreach ($hasAccess['contactPersons'] as $user) {
                                    echo '<li>' . $user->name . '</li>';
                                }
                                ?>
                            </ul>
                            <h3><?= __('Has access via groups') ?></h3>
                            <ul>
                                <?php
                                foreach ($hasAccess['groupMembers'] as $user) {
                                    echo '<li>';
                                    echo $user->name;
                                    if (isset($user->_matchingData['Groups']->name)) {
                                        echo ' / ' . $user->_matchingData['Groups']->name;
                                    }
                                    echo '</li>';
                                }
                                ?>
                            </ul>
                            <h3><?= __('Has access via user groups') ?></h3>
                            <ul>
                                <?php
                                foreach ($hasAccess['usergroupMembers'] as $user) {
                                    echo '<li>';
                                    echo $user->name;
                                    if (isset($user->_matchingData['Usergroups']->name)) {
                                        echo ' / ' . $user->_matchingData['Usergroups']->name;
                                    }
                                    echo '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="tabs-8" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="column large-12">
                            <?php if (h($contact->email)) : ?>
                            <h6 class="subheader"><?= __('Sender') ?></h6>
                            <?= $this->request->session()->read('Auth.User.email') ?>
                            <h6 class="subheader"><?= __('To') ?></h6>
                            <?= h($contact->email) ?>
                            <?php
                            echo $this->Form->control('subject');
                            echo $this->Form->control(
                                'message',
                                ['type' => 'textarea']
                            );
                            echo $this->Form->button(__('Submit'), ['id' => 'sendmail']);
                            ?>

                            <?php
                        else :
                            echo __('We do not have the contact\'s email address, so we can not send mail');
                        endif;
                        ?>
                        </div>
                    </div>
                </div>

                <div id="tabs-9" class="large-12 medium-12 small-12 columns">
                    <div class="row">
                        <div class="column large-12">

                            <!-- Új dokumentum hozzáadása -->
                            <h5><?= __('Upload new documents') ?></h5>
                            <?php
                            echo $this->Form->create(
                                null,
                                [
                                    'url' => ['controller' => 'Contacts', 'action' => 'documentSave'],
                                    'type' => 'file',
                                ]
                            );
                            echo $this->Form->control('document_title');
                            ?>
                            <label><?= __('File:') ?></label>
                            <?php
                            echo $this->Form->file('uploadfile');
                            echo $this->Form->hidden('contactid', ['value' => $contact->id]);
                            echo "<br>";
                            echo $this->Form->submit();
                            echo $this->Form->end();
                            ?>
                            <br><br>
                            <table id="hTable" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>&nbsp;&nbsp;</th>
                                        <th><?= __('Document title') ?></th>
                                        <th><?= __('Uploader') ?></th>
                                        <th><?= __('Size') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th>&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contact->documents as $document) : ?>
                                    <tr>
                                        <td>
                                            <?php
                                            switch ($document->file_type): case 'application/pdf':
                                                    echo $this->Html->image('doctype_icon_pdf.png');
                                                    break;
                                                case 'image/jpeg':
                                                    echo $this->Html->image('doctype_icon_jpg.png');
                                                    break;
                                                case 'image/png':
                                                    echo $this->Html->image('doctype_icon_png.png');
                                                    break;
                                                case 'text/plain':
                                                    echo $this->Html->image('doctype_icon_txt.png');
                                                    break;
                                                default:
                                                    echo $this->Html->image('doctype_icon_unk.png');
                                            endswitch;
                                            ?>
                                        </td>
                                        <td><?php echo $document->name; ?></td>
                                        <td>
                                            <?php
                                            foreach ($uploaders as $uploader) :
                                                if ($document->user_id == $uploader->id) :
                                                    echo $uploader->name;
                                                endif;
                                            endforeach;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Number->toReadableSize($document->size);
                                            ?>
                                        </td>
                                        <td><?php echo $document->created; ?></td>
                                        <td><?php echo $this->Html->link(
                                                __('Download'),
                                                ['action' => 'documentGet', $document->id]
                                            ); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>