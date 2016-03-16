<?php
print $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>

<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Save Query'), [], ['id' => 'savequery']) ?></li>
        </ul>
        <h6><?= __('Saved Queries') ?></h6>
        <ul id="savedqueries">
            <?php
            if (isset($savedQueries)) {
                foreach ($savedQueries as $q) {
                    parse_str($q->value, $savedQuery);
                    print '<li>';
                        print $this->Html->link($savedQuery['qName'], ['action' => 'searchquery', $q->id]);
                    print '</li>';
                }
            }

            ?>
        </ul>
    </nav>
    <div id="dialog">
        <?php
        print $this->Form->create(null, ['id' => 'querySaveForm']);
        print $this->Form->input(
            'queryname',
            [
                'class' => 'radius',
                 'type' => 'text'
            ]
        );
        print $this->Form->button(__('Save'), ['class' => 'radius']);
        print $this->Form->end();
        ?>
    </div>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <div class="contacts index columns large-12">
            <h1>
                <?php
                print __('Queries');
                if (isset($queryArray['qName'])) {
                    print ' / ' . $queryArray['qName'];
                    unset($queryArray['qName']);
                    print $this->Html->image(
                        'remove.png',
                        [
                            'class' => 'ajaxremove',
                            'title' => __('Click to delete')
                        ]
                    );

                }
                ?>
            </h1>
            <?php
            print $this->Form->create(
                null,
                [
                    'type' => 'get',
                    'id' => 'queryForm'
                ]
            );

                print '<div id="query-select-box" class="small">';
                    print '<h2>' . __('I want to see') . '</h2>';
                    $filterFields = [
                        'contactname' => __('Contactname'),
                        'legalname' => __('Legalname'),
                        'Zips.zip' => __('Zip'),
                        'Zips.name' => __('City'),
                        'address' => __('Address'),
                        'phone' => __('Phone'),
                        'email' => __('Email'),
                        'birth' => __('Birth'),
                        'sex' => __('Sex'),
                        'workplace' => __('Workplace'),
                        'WorkplaceZips.zip' => __('Workplace_zip'),
                        'WorkplaceZips.name' => __('Workplace_city'),
                        'workplace_address' => __('Workplace_address'),
                        'workplace_phone' => __('Workplace_phone'),
                        'workplace_email' => __('Workplace_email'),
                        'Contactsources.name' => __('Contactsource'),
                        'comment' => __('Comment'),
                        'created' => __('Created'),
                        'modified' => __('Modified'),
                        'Groups.name' => __('Groups')
                        ];
                    foreach ($filterFields as $field => $fLabel) {
                        if ( ! empty($selected) && in_array($field, $selected)) {
                            $css = 'tag-viewable';
                        } else {
                            $css = 'tag-default';
                        }
                        if (strpos($field, '.')) {
                            $dataName = $field;
                        } else {
                            $dataName = 'Contacts.'.$field;
                        }
                        print '<span class="tag ' . $css . '" data-name="' . $dataName . '">';
                            print $fLabel;
                        print '</span>';
                    }
                print '</div>';

                print '<div class="cl small">';
                print '<h2>' . __('Where') . '</h2>';
                print '<div id="where">';

                if (isset($queryArray)) {
                    foreach ($queryArray as $name => $values) {
                        if ( ! is_array($values)) {        //connect
                            if (strpos($name, 'connect_') === 0) {
                                $dataName = preg_replace('/_/', '.', str_replace('connect_', '', $name), 1);
                                if (substr($values, 0, 1)  == '&' || $values == ''){
                                    $img = 'and.png';
                                    $title = '*' . __('and') . '* ' . __('Click to change');
                                } else {
                                    $img = 'or.png';
                                    $title = '*' . __('or') . '* ' . __('Click to change');
                                }
                                $connect[$dataName] = $this->Html->image(
                                    $img,
                                    [
                                        'class' => 'fl',
                                        'title' => $title
                                    ]
                                );
                                $connect[$dataName] .= '<input
                                    type="hidden"
                                    value="'. $values . '"
                                    name="connect_' . $dataName . '">';
                            }
                        } else {
                            foreach ($values as $vi => $value) {
                                if (strpos($name, 'condition_') === 0) {
                                    if ($vi == 0) {
                                        $dataName = preg_replace('/_/', '.', str_replace('condition_', '', $name), 1);
                                        $imgPlus[$dataName] = $this->Html->image(
                                            'plus.png',
                                            [
                                                'class' => 'fl',
                                                'data-name' => $dataName
                                            ]
                                        );
                                        $label[$dataName] = '<label id="l' .
                                            preg_replace('/./', '_', $dataName, 1) . '" for="' . $dataName . '">';
                                        $fName = str_replace('Contacts.', '', $dataName);
                                        $label[$dataName] .= $filterFields[$fName];
                                        $label[$dataName] .= '</label>';

                                        $selects[$dataName][] = $this->Form->select(
                                            $name . '[]',
                                            [
                                                '&%' => __('contains'),
                                                '&=' => '=',
                                                '&!' => __('not'),
                                                '&<' => '<',
                                                '&>' => '>'
                                            ],
                                            ['value' => $value]
                                        );
                                    } else {
                                        $selects[$dataName][] = $this->Form->select(
                                            $name . '[]',
                                            [
                                                '---' . __('and') . '---' => [
                                                    '&%' => __('and') . ' ' . __('contains'),
                                                    '&=' => __('and') . ' ' . '=',
                                                    '&!' => __('and') . ' ' . __('not'),
                                                    '&<' => __('and') . ' ' . '<',
                                                    '&>' => __('and') . ' ' . '>'
                                                ],
                                                '---' . __('or') . '---' => [
                                                    '|%' => __('or') . ' ' . __('contains'),
                                                    '|=' => __('or') . ' ' . '=',
                                                    '|!' => __('or') . ' ' . __('not'),
                                                    '|<' => __('or') . ' ' . '<',
                                                    '|>' => __('or') . ' ' . '>']
                                                ],
                                                ['value' => $value]
                                        );
                                    }
                                } elseif (strpos($name, 'field_') === 0) {
                                    $inputs[$dataName][] = '<input
                                        type="text"
                                        name="field_' . $dataName . '[]"
                                        value="' . $value . '">';
                                }
                            }
                        }
                    }

                    if (isset($imgPlus)) {
                        foreach($imgPlus as $dataName => $x) {
                            print '<div data-name="' . $dataName . '">';
                                if (isset($connect[$dataName])) {
                                    print $connect[$dataName];
                                }
                                print $imgPlus[$dataName];
                                print $label[$dataName];
                                foreach ($selects[$dataName] as $i => $select) {
                                    print $select;
                                    print $inputs[$dataName][$i];
                                }
                            print '</div>';
                        }
                    }
                }
            print '</div>';
            print '<div class="cl">';
            print $this->Form->button(__('Search'), ['id' => 'sButton', 'class' => 'radius']);
            print '&nbsp;';
            print $this->Form->button(__('Save as CSV'), ['id' => 'csvButton', 'class' => 'radius']);
            print '</div>';

            print '</div>';

            print $this->Form->end();
            ?>
        </div>

        <div class="contacts form large-10 medium-9 columns">
            <?php
            if (isset($contacts)){
                print '<h2>' . __('Search results') . '</h2>';

                print $this->element(
                    'contacts_table',
                    [
                        'fields' => $selected,
                        'contacts' => $contacts,
                        'settings' => false,
                        'fieldNames' => $filterFields
                    ]
                );
            }
            ?>
        </div>
    </div>
</div>
