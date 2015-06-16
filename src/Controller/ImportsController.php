<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ImportsController extends AppController
{

    public function isAuthorized($user = null)
    {
		return true;
	}
    
    public function index()
    {
        //debug($this->request->data);
        if (! empty($this->request->data)
                && is_uploaded_file($this->request->data['file']['tmp_name']))
		{	//az is_uploaded_file biztosítja, hogy ne lehessen külső fájlokat feltölteni a webről
        	
            
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $file_mime = finfo_file($finfo, $this->request->data['file']['tmp_name']);
            finfo_close($finfo);
            
            if (in_array($file_mime, ['application/vnd.ms-excel','text/plain','text/csv']))
			{   //csv

                $fileData = fread(fopen($this->request->data['file']['tmp_name'], "r"), $this->request->data['file']['size']);
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
                
                array_shift($fileData);     //remove header - field names
                
                $errors = $dataArray = [];
                $imported = $notImported = 0;
                foreach ($fileData as $i => $row)
				{
                    $dataArray[$extraField] = '';
                    $data = explode(';', $row);
                    foreach ($fields as $j => $field)
					{
                        if (in_array($field, ['contactname','legalname','zip','address','phone','email',
                                              'birth','sex','workplace','workplace_zip',
                                              'workplace_address','workplace_phone','workplace_email',
                                              'contactsource_id','comment', 'skills', 'groups']))
						{     //if this is the $field, the column exists in the contacts or its related tables
                            if (isset($data[$j]) && $data[$j]) {
                                switch ($field)
								{
                                    case 'birth' : 
                                        $data[$j] = substr($data[$j], 0, 10);
                                        break;
                                    case 'zip' :
                                    case 'workplace_zip' :
                                        if (mb_strpos($data[$j], ' ') === false) {
                                            $data[$j] = $this->Zips->getIdForZip($data[$j]);
                                        } else {
                                            $data[$j] = $this->Zips->getIdForZip(explode(' ', $data[$j]));
                                        }
                                        $field .= '_id';
                                        break;
                                    case 'skills' :
                                        if (mb_strpos($data[$j], ',') === false) {
                                            $skill_ids = [$data[$j]];
                                        } else {
                                            $skill_ids = explode(',', $data[$j]);
                                        }
                                        $data[$j] = ['_ids' => $skill_ids];
                                        break;
                                    case 'groups' :
                                        if (mb_strpos($data[$j], ',') === false) {
                                            $group_ids = [$data[$j]];
                                        } else {
                                            $group_ids = explode(',', $data[$j]);
                                        }
                                        $data[$j] = ['_ids' => $group_ids];
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
                    if (empty($dataArray[$extraField]))
					{
                        unset($dataArray[$extraField]);
                    }
                    
                    if ( ! empty($dataArray))
					{
                        $dataArray['users'] = ['_ids' => [$this->Auth->user('id')]];    //add myself as the contact person
                        //debug($dataArray);
                        $contact = $this->Contacts->newEntity($dataArray);
                        $contact->loggedInUser = $this->Auth->user('id');
                        //debug($contact);
                        $e = $contact->errors();
                        if (empty($e)) {
                            if ($this->Contacts->save($contact)) {
                                $imported++;
                            } else {
                                $notImported++;
                                $errors[] = ['errors' => $this->getErrors($contact->errors()),
                                            'data' => $dataArray];
                            }
                        } else {
                            $notImported++;
                            $errors[] = ['errors' => $this->getErrors($contact->errors()),
                                        'data' => $dataArray];
                        }
                        unset($dataArray);
                    }
                }
                $this->set('errors', $errors);
                $this->set('fields', $fields);
                $this->set('imported', $imported);
                $this->set('notImported', $notImported);
            } else {
                $this->Flash->error(__('The import file was not in the proper format. Download the sample file and save as a csv.'));
            }
        }
    }    
}
