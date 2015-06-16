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
				$this->Settings = TableRegistry::get('Settings');
                
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
                            if ((isset($data[$j]) && $data[$j]) || $field == 'groups') {	//we have defaults for groups so we should handle even if it is empty
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
	
	private function handleGroups($groups)
	{
		$group_ids = $this->Settings->getDefaultGroups();
		
		if (empty($groups))
		{
			return ['_ids' => $group_ids];
		}

		if (strpos($groups, ',') === false) {
			if ($groups < 0)
			{	//if it is a negative number
				if(($key = array_search(abs($groups), $group_ids)) !== false) {
					//and it is present in the default array, remove it
					unset($group_ids[$key]);
				}
			} else {	//if it is positive just add it
				$group_ids[] = (int) $groups;
			}
		} else {
			$newGroups = explode(',', $groups);
			foreach($newGroups as $nGroup)
			{	//if it is a negative number
				if ($nGroup < 0)
				{
					if(($key = array_search(abs($nGroup), $group_ids)) !== false) {
						unset($group_ids[$key]);
					}
				} else {	//if it is positive just add it
					$group_ids[] = (int) $nGroup;
				}
			}
		}
		return ['_ids' => $group_ids];
	}
}
