<?= $this->Html->image(
    'ajax-loader.gif',
    ['id' => 'ajaxloader', 'class' => 'column large-1 hidden', 'title' => __('Saving...')]
) ?>
<?= $this->Html->image(
    'ok.png',
    ['id' => 'okImg', 'class' => 'column large-1 hidden', 'title' => __('Saved')]
) ?>
<?= $this->Html->image(
    'error.png',
    ['id' => 'errorImg', 'class' => 'column large-1 hidden', 'title' => __('There was some error')]
) ?>

<i class="fi-check column large-1 hidden" id="ajaxsave" title="<?= __('Click here to save') ?>"></i>