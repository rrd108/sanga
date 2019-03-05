<div class="paginator column">
    <ul class="pagination centered row align-center">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'));
        echo $this->Paginator->numbers();
        echo $this->Paginator->next(__('next') . ' >');
        ?>
    </ul>
    <div class="pagination-counter row align-center">
        <?= $this->Paginator->counter() ?>
    </div>
</div>