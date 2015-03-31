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
        if (!empty($this->request->data)
                && is_uploaded_file($this->request->data['file']['tmp_name'])) {	//az is_uploaded_file biztosítja, hogy ne lehessen külső fájlokat feltölteni a webről
        	
            
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $file_mime = finfo_file($finfo, $this->request->data['file']['tmp_name']);
            finfo_close($finfo);
            
            if (in_array($file_mime, ['application/vnd.ms-excel','text/plain','text/csv'])) {   //csv

                $fileData = fread(fopen($this->request->data['file']['tmp_name'], "r"), $this->request->data['file']['size']);
                $fileData = explode("\n", $fileData);
                
                //data[0] name;contactname;zip;address;phone;email;birth;sex;workplace;workplace_zip;workplace_address;workplace_phone;workplace_email;contactsource_id;comment;x;szÃ¼letÃ©si nÃ©v;guru;ideiglenes cÃ­m;szÃ¡llÃ¡s;szig;ÃºtlevÃ©l;adÃ³azonosÃ­tÃ³;taj;szÃ¼letÃ©si hely;Ã¡llampolgÃ¡rsÃ¡g;katonasÃ¡g;hÃ¡ziorvos;hÃ¡ziorvos cÃ­m;hÃ¡ziorvos telefon;elsÅ‘ talÃ¡lkozÃ¡s KT-tal;elfogadÃ¡s dÃ¡tuma;elsÅ‘ avatÃ¡s;mÃ¡sodik avatÃ¡s;asram;tb;tagsÃ¡g;vÃ©gzettsÃ©g;szakma;vÃ©gakarat;halÃ¡l esetÃ©n Ã©rtesÃ­tendÅ‘;bhakti sastri ideje;bhakti sastri eredmÃ©nye;nyelvtudÃ¡s;anyja neve;apja neve;csalÃ¡d hozzÃ¡lÃ¡Ã¡sa;india;RS szerzÅ‘dÃ©s;aktÃ­v;Bhakta nyilvÃ¡ntartÃ¡s id',
                $fields = explode(";", $fileData[0]);
                $extraField = 'comment';
                $this->Contacts = TableRegistry::get('Contacts');
                
                array_shift($fileData);     //remove header - field names
                $dataArray = [];
                foreach ($fileData as $i => $row) {
                    $dataArray[$extraField] = '';
                    $data = explode(';', $row);
                    foreach ($fields as $j => $field) {
                        if (in_array($field, ['name','contactname','zip','address','phone','email',
                                              'birth','sex','workplace','workplace_zip',
                                              'workplace_address','workplace_phone','workplace_email',
                                              'contactsource_id','comment'])) {     //if this column exists in the contacts table
                            if (isset($data[$j]) && $data[$j]) {
                                if ($field == 'birth') {
                                    $data[$j] = substr($data[$j], 0, 10);
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
                    
                    if ( ! empty($dataArray)){
                        $dataArray['users'] = ['_ids' => [$this->Auth->user('id')]];    //add myself as the contact person
                        //debug($dataArray);
                        $contact = $this->Contacts->newEntity($dataArray);
                        $contact->loggedInUser = $this->Auth->user('id');
                        //debug($contact);
                        if (empty($contact->errors())) {
                            if ($this->Contacts->save($contact)) {
                                $this->Flash->success(__('The contact (%s) has been saved.', $i));
                            } else {
                                $this->Flash->error(__('The contact (%s) is not saved.', $i));
                            }
                        } else {
                            foreach ($contact->errors() as $field => $errors) {
                                foreach ($errors as $rule => $error)
                                $this->Flash->error($i . ' / ' . $field . ' / ' . $rule . ' / ' . $error);
                            }
                            /*
                            [
                                'birth' => [
                                    'valid' => 'The provided value is invalid'
                                ]
                            ]
                            */
                        }
                        unset($dataArray);
                    }
                }
            }
        }
    }
}
