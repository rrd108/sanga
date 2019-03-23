<tr>
    <td>
        <?php if (isset($contactId)) : ?>
            <?= $this->Form->input('contact_id', ['type' => 'hidden', 'value' => $contactId]) ?>
        <?php else : ?>
            <?= $this->Form->input('contact_id', ['type' => 'hidden']) ?>
            <?= $this->Form->input('xcontact_id', ['type' => 'text', 'label' => false]) ?>
        <?php endif; ?>
    </td>
    <td>
        <?= $this->Form->input(
            'date',
            [
                'label' => false,
                'value' => date('Y-m-d')
            ]
        ) ?>
    </td>
    <td id="uName">
        <?= $this->request->session()->read('Auth.User.name') ?>
    </td>
    <td>
        <?= $this->Form->control(
            'group_id',
            [
                'type' => 'text',
                'data-ac' => '/groups/search',
                'templates' => [
                    'inputContainer' => '{{content}}',
                    'label' => false
                ]
            ]
        ) ?>
    </td>
    <td>
        <?= $this->Form->control(
            'event_id',
            [
                'type' => 'text',
                'data-ac' => '/events/search',
                'templates' => [
                    'inputContainer' => '{{content}}',
                    'label' => false
                ]
            ]
        ) ?>
    </td>
    <td>
        <?= $this->Form->input('detail', ['label' => false]) ?>
    </td>
    <td class="input-group">
        <?= $this->Form->input(
            'quantity',
            [
                'label' => false,
                'class' => 'quantity input-group-field'
            ]
        ) ?>
        <span class="input-group-label">Ft</span>
        <?= $this->Form->input(
            'unit_id',
            [
                'type' => 'hidden',
                'value' => 1        //TODO hardcoded value for HUF
            ]
        ) ?>
    </td>
    <td id="hInfo" class="text-center">
        <?= $this->Form->submit('ok.png', ['id' => 'hsave']) ?>
    </td>
</tr>