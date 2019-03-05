<?= $this->Html->script('sanga.contacts.import.js', ['block' => true]); ?>
<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
        <li><?= $this->Html->link(__('Sample import file'), $this->Html->webroot . '/files/contact_csv-import.xlsx') ?></li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <h1><?= __('Contact Import') ?></h1>
        <div class="imports index large-10 medium-9 columns">
            <?php
            echo $this->Form->create(null, ['type' => 'file']);
            echo $this->Form->input('file', ['type' => 'file']);
            echo $this->Form->submit(__('Submit'), ['class' => 'button']);
            echo $this->Form->end();
            ?>
        </div>
    </div>

    <?php if (isset($imported) && $imported) : ?>
    <div class="row">
        <h2><?= __('Imported') ?></h2>
        <div class="imports index large-10 medium-9 columns">
            <p class="message success">
                <?= __('Imported {0} contacts', $imported) ?>
            </p>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($notImported) && $notImported) : ?>
    <div class="row">
        <h3><?= __('Errors') ?></h3>
        <div class="imports index large-10 medium-9 columns">
            <p class="message error">
                <?= __('Not imported {0} contacts', $notImported) ?>
            </p>
            <?php
            //debug($fields);
            //debug($errors);
            array_push($fields, __('Save'));
            echo '<table>';
                echo $this->Html->tableHeaders($fields);
                foreach ($errors as $e) {
                    echo '<tr>';
                        foreach ($fields as $field) {
                            $tdContent = $tdTitle = $tdClass = '';
                            if (isset($e['data'][$field])) {
                                if (isset($e['errors']) && strpos($e['errors'], $field) !== false)
                                {
                                    $tdTitle =  ' title="' . $e['errors'] . ' ' . __('Click to edit') . '"';
                                    $tdClass = ' class="message error"';
                                    $tdContent = $e['data'][$field];
                                } else{
                                    $tdContent = $e['data'][$field];
                                }
                            }
                            echo '<td' . $tdTitle . $tdClass . '>';
                                if (is_array($tdContent))
                                {
                                    echo implode(',', $tdContent['_ids']);
                                } else {
                                    echo $tdContent;
                                }
                            echo '</td>';
                        }
                    echo '</tr>';
                }
            echo '</table>';
            ?>
        </div>
    </div>
    <?php endif; ?>
</div>
