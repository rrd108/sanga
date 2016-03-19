<?php
echo $this->Html->script('sanga.contacts.index.js', ['block' => true]);
?>
<div id="dialog">
    <h4><?= __('Choose columns to display') ?></h4>
    <?php
    echo $this->Form->create($contacts, ['id' => 'settingsForm']);
    echo $this->Form->input('contactname', ['type' => 'checkbox']);
    echo $this->Form->input('legalname', ['type' => 'checkbox']);
    echo $this->Form->input('zip_id', ['type' => 'checkbox']);
    echo $this->Form->input('address', ['type' => 'checkbox']);
    echo $this->Form->input('phone', ['type' => 'checkbox']);
    echo $this->Form->input('email', ['type' => 'checkbox']);
    echo $this->Form->input('birth', ['type' => 'checkbox']);
    echo $this->Form->input('workplace', ['type' => 'checkbox']);
    echo $this->Form->input('workplace_zip_id', ['type' => 'checkbox']);
    echo $this->Form->input('workplace_address', ['type' => 'checkbox']);
    echo $this->Form->input('workplace_phone', ['type' => 'checkbox']);
    echo $this->Form->input('workplace_email', ['type' => 'checkbox']);
    echo $this->Form->input('contactsource_id', ['type' => 'checkbox']);

    echo $this->Form->input('users', ['type' => 'checkbox']);
    echo $this->Form->input('skills', ['type' => 'checkbox']);
    echo $this->Form->input('groups', ['type' => 'checkbox']);

    echo $this->Form->input('sName', ['type' => 'hidden', 'value' => 'Contacts/index']);
    echo $this->Form->button(__('Submit'), ['id' => 'submitSettings', 'class' => 'radius']);
    echo $this->Form->end();
    ?>
</div>
<div class="row">
    <div class="contacts index columns large-12">
        <?php
        echo $this->element(
            'contacts_table',
            [
                'fields' => array_keys($this->request->data),
                'contacts' => $contacts,
                'settings' => true
            ]
        );
        ?>
    </div>
</div>