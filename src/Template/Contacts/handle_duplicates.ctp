<div class="content-wrapper">
    <div class="row">
        <h1><?= __('Handle Duplicates') ?></h1>
        <?php
        if (isset($error)) :
            print '<p>' . $error . '</p>';
        ?>
    </div>
    <?php
    else :
    //TODO have a nice GUI for merging the contacts
        print '<p>Ez a funkció még nincs kész. Sürgős esetben a generált filelal tudsz dolgozni</p>';
    endif;
    ?>
</div>
