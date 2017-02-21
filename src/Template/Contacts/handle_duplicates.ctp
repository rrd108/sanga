<?php
print $this->Html->script('sanga.contacts.handle_duplicates.js', ['block' => true]);
?>
<div class="content-wrapper">
    <div class="row">
        <h1><?= __('Handle Duplicates') ?></h1>
        <?php
        if (isset($error)) :
            print '<p>' . $error . '</p>';
        ?>
    </div>
    <div class="row">
        <?php
        else :
            print '<h3>' . __('Steps for handling duplicates') . '</h3>';
            print '<ol>';
            print '<li>' . __('One block shows contacts seemed to be duplicates. If any of them is not a duplicate 
                remove them by clicking the non duplicate button at the top.') . '</li>';
            print '<li>' . __('After this you can select which values are correct by clicking on them.') . '</li>';
            print '<li>' . __('When you are ready with a block click Merge. This will save the selected values 
                for the user, and merge group memberships, skills, histories, etc from the duplicated contacts.') . '</li>';
            print '</ol>';
            print '<p>' . __('Be careful after mergeing there is no way to cancel what you did.') . '</p>';
            $i = 0;
            $usedContactIds = [];
            foreach ($duplicateIds as $contactId => $dIds) {
                //filter out duplicated contact entries
                $cIds = $similarFields = [];

                foreach ($dIds as $d) {
                    if (!in_array($duplicates[$d]->id1, $cIds) && !in_array($duplicates[$d]->id1, $usedContactIds)) {
                        array_push($cIds, $duplicates[$d]->id1);
                        array_push($usedContactIds, $duplicates[$d]->id1);
                    }
                    if (!in_array($duplicates[$d]->id2, $cIds) && !in_array($duplicates[$d]->id2, $usedContactIds)) {
                        array_push($cIds, $duplicates[$d]->id2);
                        array_push($usedContactIds, $duplicates[$d]->id2);
                    }
                    if (is_string($duplicates[$d]->field)) {
                        if (!in_array($duplicates[$d]->field, $similarFields)) {
                            array_push($similarFields, $duplicates[$d]->field);
                        }
                    } elseif (is_array($duplicates[$d]->field)) {
                        foreach ($duplicates[$d]->field as $f) {
                            if (!in_array($f, $similarFields)) {
                                array_push($similarFields, $f);
                            }
                        }
                    }
                }

                if (count($cIds)) {
                    print '<h2>' . ++$i . ' <span class="setChange">Merge</span></h2>';
                    print '<table class="duplicates">';
                    $w = 100 / (count($cIds) + 1);

                    print '<tr>';
                    print '<td style="width: ' . $w . '%">' . __('Non duplicate') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td style="width: ' . $w . '%">';
                        print '<span class="setChange" title="' . __('Non duplicate') . '">✖</span>';
                        print '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>id</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->id . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('name', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Legalname') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->legalname . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('name', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Contactname') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->contactname . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('geo', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Zip') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' .
                            ((isset($contacts[$cId]->zip) && isset($contacts[$cId]->zip->zip))
                                ? $contacts[$cId]->zip->zip
                                : '') .
                            '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('geo', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('City') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' .
                            (isset($contacts[$cId]->zip) && isset($contacts[$cId]->zip->name)
                                ? $contacts[$cId]->zip->name
                                : '') .
                            '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('geo', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Address') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->address . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('phone', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Phone') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->phone . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('email', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Email') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->email . '</td>';
                    }
                    print '</tr>';

                    print '<tr' . ((in_array('birth', $similarFields)) ? ' class="similar"' : '') .' >';
                    print '<td>' . __('Birthday') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->birth . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Sex') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->sex . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Workplace') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->workplace . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Zip') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' .
                            (isset($contacts[$cId]->workplace_zip) && isset($contacts[$cId]->workplace_zip->zip)
                                ? $contacts[$cId]->workplace_zip->zip
                                : '') .
                            '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('City') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' .
                            (isset($contacts[$cId]->workplace_zip) && isset($contacts[$cId]->workplace_zip->name)
                                ? $contacts[$cId]->workplace_zip->name
                                : '') .
                            '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Address') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->workplace_address . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Phone') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->workplace_phone . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Email') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->workplace_email . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Family') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->family_id . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Contactsource') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->contactsource_id . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Active') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->active . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Comment') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->comment . '</td>';
                    }
                    print '</tr>';

                    print '<tr>';
                    print '<td>' . __('Google') . '</td>';
                    foreach ($cIds as $cId) {
                        print '<td>' . $contacts[$cId]->google_id . '</td>';
                    }
                    print '</tr>';

                    print '</table>';
                }
            }
        endif;
        ?>
    </div>
</div>
