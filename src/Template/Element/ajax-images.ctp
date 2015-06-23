<?php
//ajax loader, ok and error
echo $this->Html->image('ajax-loader.gif', ['id' => 'ajaxloader', 'title' => __('Saving...')]);
echo $this->Html->image('ok.png', ['id' => 'okImg', 'title' => __('Saved')]);
echo $this->Html->image('error.png', ['id' => 'errorImg', 'title' => __('There was some error')]);
echo $this->Form->submit('ajaxsave.png', ['id' => 'ajaxsave', 'title' => __('Click here to save')]);
?>