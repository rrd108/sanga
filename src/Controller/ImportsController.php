<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;

class ImportsController extends AppController
{

    public function isAuthorized($user = null)
    {
        return true;
    }

    public function contacts()
    {
        //debug($this->request->data);
        if (!empty($this->request->getData())
            && is_uploaded_file($this->request->getData('file.tmp_name'))
        ) {
            if ($this->isCsv($this->getMime())) {
                $fileData = $this->getFileDate();
                if ($this->isUtf8($fileData)) {
                    $fileData = explode("\n", $fileData);

                    /*data[0]
                     *name;contactname;zip;address;phone;email;birth;sex;workplace;workplace_zip;
                     *workplace_address;workplace_phone;workplace_email;
                     *contactsource_id;comment;skills;
                     *  groups;
                     *x;egyebek
                     */
                    $fields = explode(";", $fileData[0]);
                    $extraField = 'comment';
                    $this->Contacts = TableRegistry::get('Contacts');
                    $this->Zips = TableRegistry::get('Zips');
                    $this->Settings = TableRegistry::get('Settings');

                    array_shift($fileData);     //remove header - field names

                    $errors = $dataArray = [];
                    $imported = $notImported = 0;

                    foreach ($fileData as $i => $row) {
                        $dataArray[$extraField] = '';
                        $data = explode(';', $row);
                        foreach ($fields as $j => $field) {
                            if (in_array(
                                $field,
                                [
                                    'contactname',
                                    'legalname',
                                    'zip',
                                    'address',
                                    'phone',
                                    'email',
                                    'birth',
                                    'sex',
                                    'workplace',
                                    'workplace_zip',
                                    'workplace_address',
                                    'workplace_phone',
                                    'workplace_email',
                                    'contactsource_id',
                                    'comment',
                                    'skills',
                                    'groups',
                                    'created'
                                ]
                            )) {     //if this is the $field, the column exists in the contacts or its related tables
                                if ((isset($data[$j]) && $data[$j]) || $field == 'groups') {    //we have defaults for groups so we should handle even if it is empty
                                    switch ($field) {
                                        case 'birth':
                                            $data[$j] = substr($data[$j], 0, 10);
                                            break;
                                        case 'zip':
                                        case 'workplace_zip':
                                            if (mb_strpos($data[$j], ' ') === false) {
                                                $data[$j] = $this->Zips->getIdForZip($data[$j]);
                                            } else {
                                                $data[$j] = $this->Zips->getIdForZip(explode(' ', $data[$j]));
                                            }
                                            $field .= '_id';
                                            break;
                                        case 'skills':
                                            if (mb_strpos($data[$j], ',') === false) {
                                                $skill_ids = [$data[$j]];
                                            } else {
                                                $skill_ids = explode(',', $data[$j]);
                                            }
                                            $data[$j] = ['_ids' => $skill_ids];
                                            break;
                                        case 'groups':
                                            $data[$j] = $this->handleGroups($data[$j]);
                                            break;
                                    }
                                    $dataArray[$field] = $data[$j];
                                }
                            } else {
                                if (isset($data[$j]) && $data[$j]) {
                                    $dataArray[$extraField] .= "\n" . $field . ': ' . $data[$j];
                                }
                            }
                        }
                        if (empty($dataArray[$extraField])) {
                            unset($dataArray[$extraField]);
                        }

                        if (!empty($dataArray)) {
                            $dataArray['users'] = ['_ids' => [$this->Auth->user('id')]];    //add myself as the contact person
                            //debug($dataArray);
                            $contact = $this->Contacts->newEntity($dataArray);
                            $contact->loggedInUser = $this->Auth->user('id');
                            $e = $contact->errors();
                            if (empty($e)) {
                                if ($this->Contacts->save($contact)) {
                                    $imported++;
                                } else {
                                    $notImported++;
                                    $errors[] = [
                                        'errors' => $this->getErrors($contact->errors()),
                                        'data' => $dataArray
                                    ];
                                }
                            } else {
                                $notImported++;
                                $errors[] = [
                                    'errors' => $this->getErrors($contact->errors()),
                                    'data' => $dataArray
                                ];
                            }
                            unset($dataArray);
                        }
                    }
                } else {
                    $this->Flash->error(__('The import file was not a valid UTF-8 encoded csv file. Regenerate it.'));
                    $this->Flash->error(__('Nothing is imported'));
                }
                $this->set('errors', $errors);
                $this->set('fields', $fields);
                $this->set('imported', $imported);
                $this->set('notImported', $notImported);
            } else {
                $this->Flash->error(__('The import file was not in the proper format. Download the sample file and save as a csv.'));
                $this->Flash->error(__('Nothing is imported'));
            }
        }
    }

    private function handleGroups($groups)
    {
        $group_ids = $this->Settings->getDefaultGroups();

        if (empty($groups)) {
            return ['_ids' => $group_ids];
        }

        if (strpos($groups, ',') === false) {
            if ($groups < 0) {    //if it is a negative number
                if (($key = array_search(abs($groups), $group_ids)) !== false) {
                    //and it is present in the default array, remove it
                    unset($group_ids[$key]);
                }
            } else {    //if it is positive just add it
                $group_ids[] = (int)$groups;
            }
        } else {
            $newGroups = explode(',', $groups);
            foreach ($newGroups as $nGroup) {
                //if it is a negative number
                if ($nGroup < 0) {
                    if (($key = array_search(abs($nGroup), $group_ids)) !== false) {
                        unset($group_ids[$key]);
                    }
                } else {    //if it is positive just add it
                    $group_ids[] = (int)$nGroup;
                }
            }
        }
        return ['_ids' => $group_ids];
    }

    public function histories()
    {
        //debug($this->request->data);
        if (!empty($this->request->getData())
            && is_uploaded_file($this->request->getData('file.tmp_name'))
        ) {
            if ($this->isCsv($this->getMime())) {
                $fileData = $this->getFileDate();
                if ($this->isUtf8($fileData)) {
                    $fileData = explode("\n", $fileData);
                    $fields = explode(";", $fileData[0]);

                    $this->Contacts = TableRegistry::get('Contacts');
                    $this->Groups = TableRegistry::get('Groups');
                    $this->Events = TableRegistry::get('Events');
                    $this->Units = TableRegistry::get('Units');
                    $this->Histories = TableRegistry::get('Histories');

                    array_shift($fileData);     //remove header - field names

                    $errors = $dataArray = [];
                    $imported = $notImported = 0;

                    foreach ($fileData as $i => $row) {
                        $data = explode(';', $row);
                        if (count($data) > 1) {
                            foreach ($fields as $j => $field) {
                                switch ($field) {
                                    case 'contact':
                                        // if $data[$j] is an integer than it is an id
                                        if (strlen($data[$j]) && !is_numeric($data[$j])) {
                                            $contact = $this->Contacts->find(
                                                'accessibleBy',
                                                [
                                                    'User.id' => $this->Auth->user('id'),
                                                    '_where' => [
                                                        'Contacts.contactname' => [
                                                            'condition' => ['&='],
                                                            'value' => [$data[$j]]
                                                        ],
                                                        'Contacts.legalname' => [
                                                            'connect' => '|',
                                                            'condition' => ['&='],
                                                            'value' => [$data[$j]]
                                                        ]
                                                    ]
                                                ]
                                            );
                                            if ($contact->count() === 1) {
                                                $data[$j] = $contact->toArray()[0]->id;
                                            } else {
                                                //no contats find or there are more results
                                                $data[$j] = -1;
                                            }
                                        }
                                        $field = 'contact_id';
                                        break;
                                    case 'date':
                                        if (!$data[$j]) {
                                            $data[$j] = date('Y-m-d');
                                        } else {
                                            $data[$j] = Date::createFromFormat('Y-m-d', $data[$j]);
                                        }
                                        break;
                                    case 'group':
                                        // if $data[$j] is an integer than it is an id
                                        if (strlen($data[$j]) && !is_numeric($data[$j])) {
                                            $group = $this->Groups->find()
                                                ->select('id')
                                                ->where(['Groups.name' => $data[$j]]);
                                            if ($group->count() == 1) {
                                                $data[$j] = $group->toArray()[0]->id;
                                            } else {
                                                $data[$j] = -1;
                                            }
                                        }
                                        $field = 'group_id';
                                        break;
                                    case 'event':
                                        // if $data[$j] is an integer than it is an id
                                        if (strlen($data[$j]) && !is_numeric($data[$j])) {
                                            $event = $this->Events->find()
                                                ->select('id')
                                                ->where(['Events.name' => $data[$j]]);
                                            if ($event->count() == 1) {
                                                $data[$j] = $event->toArray()[0]->id;
                                            } else {
                                                $data[$j] = -1;
                                            }
                                        }
                                        $field = 'event_id';
                                        break;
                                    case 'unit':
                                        // if $data[$j] is an integer than it is an id
                                        if (strlen($data[$j]) && !is_numeric($data[$j])) {
                                            $unit = $this->Units->find()
                                                ->select('id')
                                                ->where(['Units.name' => $data[$j]]);
                                            if ($unit->count() == 1) {
                                                $data[$j] = $unit->toArray()[0]->id;
                                            } else {
                                                $data[$j] = -1;
                                            }
                                        }
                                        $field = 'unit_id';
                                        break;
                                }
                                $dataArray[$field] = $data[$j];
                            }

                            if (!empty($dataArray)) {
                                $dataArray['user_id'] = $this->Auth->user('id');
                                $history = $this->Histories->newEntity($dataArray);
                                if (empty($history->errors())) {
                                    if ($this->Histories->save($history)) {
                                        $imported++;
                                    } else {
                                        $notImported++;
                                        $errors[] = [
                                            'errors' => $this->getErrors($history->errors()),
                                            'data' => $dataArray
                                        ];
                                    }
                                } else {
                                    $notImported++;
                                    $errors[] = [
                                        'errors' => $this->getErrors($history->errors()),
                                        'data' => $dataArray
                                    ];
                                }
                                unset($dataArray);
                            }
                        }
                    }
                } else {
                    $this->Flash->error(__('The import file was not a valid UTF-8 encoded csv file. Regenerate it.'));
                    $this->Flash->error(__('Nothing is imported'));
                }
                $this->set('errors', $errors);
                $this->set('fields', $fields);
                $this->set('imported', $imported);
                $this->set('notImported', $notImported);
            } else {
                $this->Flash->error(__('The import file was not in the proper format. Download the sample file and save as a csv.'));
                $this->Flash->error(__('Nothing is imported'));
            }
        }
    }

    /**
     * get mime type ala mimetype extension
     *
     * @return mixed
     */
    protected function getMime()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime = finfo_file($finfo, $this->request->getData('file.tmp_name'));
        finfo_close($finfo);
        return $file_mime;
    }

    /**
     * Check if file is a csv file
     *
     * @param $file_mime
     * @return bool
     */
    protected function isCsv($file_mime)
    {
        return in_array($file_mime, ['application/vnd.ms-excel', 'text/plain', 'text/csv']);
    }

    /**
     * @return string
     */
    protected function getFileDate(): string
    {
        $fileData = fread(fopen($this->request->getData('file.tmp_name'), "r"),
            $this->request->getData('file.size'));
        return $fileData;
    }

    /**
     * @param $fileData
     * @return bool|mixed|string
     */
    protected function isUtf8($fileData)
    {
        return mb_detect_encoding($fileData, 'UTF-8', true);
    }

    public function test()
    {
        $this->Groups = TableRegistry::get('Groups');
        $group = $this->Groups->find()
            ->select('id')
            ->where(['Groups.name' => 'india-szállítaás']);

        debug($group->toArray());
        die();
    }
}