<?php
//$this->assign('title', 'Kapcsolatok / Új');
//$this->Html->addCrumb('Kapcsolatok', '/contacts');
//$this->Html->addCrumb('Új', '/contacts/add');
print $this->Html->script('sanga.contacts.add.js', ['block' => true]);
?>
<div class="user-add-form column large-6 medium-10 small-centered">
    <?= $this->Form->create($contact) ?>
    <?php
    /*echo '<div class="row">';
    echo '<div class="column large-12">';
        echo '<label for="users-ids">'.__('Contact Person').'</label>';
        //echo $this->element('user_checkbox');
        echo '<span class="label mine">';
            echo '<input type="checkbox"
                        id="users-ids-'.$this->request->session()->read('Auth.User.id').'"
                        checked="checked"
                        value="'.$this->request->session()->read('Auth.User.id').'"
                        name="users[_ids][]">';
            echo '<label for="users-ids-'.$this->request->session()->read('Auth.User.id').'">'.
                    $this->request->session()->read('Auth.User.name').
                '</label>';
        echo '</span> ';
    echo '</div>';
    echo '</div>';*/

    echo '<fieldset id="personal_data">';
    echo '<legend>' . __('Personal data') . '</legend>';

    echo '<div class="row">';
    echo $this->Form->input('contactname',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'label' => __('Known name'),
            'title' => __('Like initiated name, nickname, etc')
        ]);
    echo $this->Form->input('legalname',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'label' => __('Legal name'),
            'title' => __('Civil name, official legal name, etc')
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('xzip',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'type' => 'text',
            'label' => __('Zip')
        ]);
    echo $this->Form->input('zip_id',
        ['type' => 'hidden']);
    echo $this->Form->input('address',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('phone',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo $this->Form->input('email',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('birth',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'type' => 'text'
        ]);
    echo $this->Form->input('sex',
        [
            'templates' => ['inputContainer' => '<div class="column large-6 medium-6 radio">{{content}}</div>'],
            'class' => 'radius',
            'type' => 'radio',
            'class' => 'radius',
            'options' => [1 => __('Male'), 2 => __('Female')]
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('xfamily',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'type' => 'text',
            'label' => __('Family')
        ]);
    echo $this->Form->input('family_member_id', ['type' => 'hidden']);
    echo '</div>';

    echo '</fieldset>';


    echo '<fieldset id="workplace_skills">';
    echo '<legend>' . __('Workplace and Skills') . '</legend>';
    echo '<div class="row">';
    echo $this->Form->input('workplace',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo $this->Form->input('skills',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'type' => 'text'
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('xworkplace_zip',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius',
            'type' => 'text',
            'label' => __('Zip')
        ]);
    echo $this->Form->input('workplace_zip_id',
        ['type' => 'hidden']);
    echo $this->Form->input('workplace_address',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('workplace_phone',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo $this->Form->input('workplace_email',
        [
            'templates' => [
                'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'class' => 'radius'
        ]);
    echo '</div>';
    echo '</fieldset>';

    echo '<div class="row">';
    echo $this->Form->input('contactsource_id',
        [
            'templates' => ['inputContainer' => '<div class="column large-12 radio">{{content}}</div>'],
            'class' => 'radius',
            'options' => $contactsources,
            'type' => 'radio'
        ]);
    echo '</div>';

    echo '<div class="row">';
    echo $this->Form->input('comment',
        [
            'templates' => ['inputContainer' => '<div class="column large-12">{{content}}</div>'],
            'class' => 'radius',
            'title' => __('Secondary emails, phones, others')
        ]);
    echo '</div>';

    $fGroups = $values = [];
    foreach ($groups as $group) {
        $fGroups[$group->id] = $group->name;
        if (is_array($default_groups) && in_array($group->id, $default_groups)) {
            $values[] = $group->id;
        }
    }

    echo '<div class="row">';
    echo '<div class="column large-12 radio">';
    echo $this->Form->input('groups._ids',
        [
            'class' => 'radius',
            'options' => $fGroups,
            'type' => 'select',
            'multiple' => 'checkbox',
            'value' => $values
        ]);
    echo '</div>';
    echo '</div>';

    ?>
    <?php
    echo '<div class="row">';
    echo '<div class="column large-12">';
    echo $this->Form->button(__('Submit'), ['class' => 'radius']);
    echo '</div>';
    echo '</div>';
    echo $this->Form->end();
    ?>
</div>
