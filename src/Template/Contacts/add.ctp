<?= $this->Html->script('jquery.rAutocompleters.min', ['block' => true]) ?>
<?= $this->Html->script('sanga.contacts.add.min', ['block' => true]) ?>

<div class="column large-11 medium-11 small-12">
    <?= $this->Form->create($contact, ['id' => 'addContact']) ?>
    <fieldset>
        <legend id="personal"><?= ('Personal data') ?></legend>

        <div class="row">
            <?= $this->Form->input(
                'contactname',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius',
                    'label' => __('Known name'),
                    'title' => __('Like initiated name, nickname, etc')
                ]
            ) ?>
            <?= $this->Form->input(
                'legalname',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius',
                    'label' => __('Legal name'),
                    'title' => __('Civil name, official legal name, etc')
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'xzip',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius',
                    'type' => 'text',
                    'label' => __('Zip')
                ]
            ) ?>
            <?= $this->Form->input(
                'zip_id',
                ['type' => 'hidden']
            ) ?>
            <?= $this->Form->input(
                'address',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'phone',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
            <?= $this->Form->input(
                'email',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'birth',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'placeholder' => __('YYYY-MM-DD'),
                    'pattern' => '^\d{4}-?(\d{2})?-?(\d{2})?$',
                    'type' => 'text'
                ]
            ) ?>
            <?= $this->Form->input(
                'sex',
                [
                    'templates' => ['inputContainer' => '<div class="column large-6 medium-6 radio">{{content}}</div>'],
                    'class' => 'radius',
                    'type' => 'radio',
                    'class' => 'radius',
                    'options' => [1 => __('Male'), 2 => __('Female')]
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'xfamily',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius',
                    'type' => 'text',
                    'label' => __('Family')
                ]
            ) ?>
            <?= $this->Form->input('family_member_id', ['type' => 'hidden']) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend id="workplaceAndSkills"><?= __('Workplace and Skills') ?></legend>

        <div class="row">
            <?= $this->Form->input(
                'workplace',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
            <?= $this->Form->input(
                'skills',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'data-ac' => '/Skills/search',
                    'type' => 'text'
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'xworkplace_zip',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius',
                    'type' => 'text',
                    'label' => __('Zip')
                ]
            ) ?>
            <?= $this->Form->input(
                'workplace_zip_id',
                ['type' => 'hidden']
            ) ?>
            <?= $this->Form->input(
                'workplace_address',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
        </div>

        <div class="row">
            <?= $this->Form->input(
                'workplace_phone',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
            <?= $this->Form->input(
                'workplace_email',
                [
                    'templates' => [
                        'inputContainer' => '<div class="column large-6 medium-6">{{content}}</div>',
                        'inputContainerError' => '<div class="column large-6 medium-6 {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'class' => 'radius'
                ]
            ) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend id="csource"><?= __('Contactsource') ?></legend>
        <div class="row">
            <?= $this->Form->input(
                'contactsource_id',
                [
                    'templates' => ['inputContainer' => '<div class="column large-12 radio">{{content}}</div>'],
                    'class' => 'radius',
                    'options' => $contactsources,
                    'type' => 'radio',
                    'label' => false,
                ]
            ) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend id="comment"><?= __('Comment') ?></legend>

        <div class="row">
            <?= $this->Form->input(
                'comment',
                [
                    'templates' => ['inputContainer' => '<div class="column large-12">{{content}}</div>'],
                    'class' => 'radius',
                    'title' => __('Secondary emails, phones, others'),
                    'label' => false,
                ]
            ) ?>
        </div>
    </fieldset>

    <fieldset id="contact-add-group">
        <legend id="groups"><?= __('Groups') ?></legend>

        <div class="row">
            <?= $this->Form->input(
                'groups._ids',
                [
                    'options' => $groups->map(function ($group, $key) {
                        return [
                            'value' => $group->id,
                            'text' => $group->name
                        ];
                    }),
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'label' => false,
                ]
            ) ?>
        </div>
    </fieldset>

    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>