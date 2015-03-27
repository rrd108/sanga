<?php
//ajax loader, ok and error
echo $this->Html->image('ajax-loader.gif', ['id' => 'ajaxloader']);
echo $this->Html->image('ok.png', ['id' => 'okImg']);
echo $this->Html->image('error.png', ['id' => 'errorImg']);
//echo $this->Html->image('ajaxsave.png', ['id' => 'ajaxsave']);
echo $this->Form->submit('ajaxsave.png', ['id' => 'ajaxsave']);
?>