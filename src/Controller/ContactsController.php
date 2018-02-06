<?php

namespace App\Controller;

class ContactsController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    
    
    /**
     * Hien thi chi tiet lien he
     * @param int $id
     */
    public function detail($id = null)
    {
        $aryField = [
            'Contacts.id',
            'Contacts.full_name',
            'Contacts.email',
            "Contacts.title",
            "Contacts.body",
            'Contacts.read_flag',
            'Contacts.red_flag',
            'Contacts.created'
        ];
        $options = ['id' => [], 'not_in_id' => FLAG_FALSE];
        $options['options'] = [
            'fields' => $aryField,
            'conditions' => [
                'Contacts.hash' => $id
            ],
        ];
        $options['joins'] = [
            'ContactsTmp' => [
                'table' => 'contacts',
                'type' => 'LEFT',
                'conditions' => '`ContactsTmp`.`root_id` = `Contacts`.`id` OR `ContactsTmp`.`root_id` = `Contacts`.`root_id`'
            ]
            
        ];
        
        $contactsResult = $this->commonFind('Contacts', $options);
        $this->set('contactsResult', $contactsResult['full_info']);
        error_log(print_r($contactsResult['full_info'], true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debugAAAAAAAAAA.txt');
        /* if (FLAG_TRUE == $contactsResult['result_flag']) {
            $options['fields']['read_flag'] = FLAG_TRUE;
            $options['conditions'] = [
                'OR' => ['id' => $id, 'root_id' => $id]
            ];
            $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
        } */
        
    }

    public function form($id = null)
    {
        $data = $this->request->getData();
        $id = $this->request->getData('id', $id);
        if($id) {
            $options = [
                'fields' => [
                    'id',
                    'root_id',
                    'parent_id',
                    'title',
                    'body',
                    'email',
                    'full_name',
                    'hash',
                    'phone_number'
                ],
                'conditions' => [
                    'hash' => $id,
                    'to_delete_flag' => FLAG_FALSE
                ],
            ];

            $contactInfo = $this->commonFind('Contacts', ['options' => $options, 'get_one' => FLAG_TRUE]);
            if(FLAG_TRUE == $contactInfo['result_flag']) {
                $data['root_id'] = $contactInfo['full_info']['id'];
                $data['parent_id'] = $contactInfo['full_info']['id'];
                if ($contactInfo['full_info']['root_id']) {
                    $data['root_id'] = $contactInfo['full_info']['root_id'];
                }
                
                $this->set('contactsInfo', $contactInfo['full_info']);
            } elseif(FLAG_FALSE === $contactInfo['result_flag']) {
                $this->Flash->error(__('MSG_CONTACT_NOT_FOUND'));
            }
        } else {
            
            $contactInfo = ['hash' => '', 'title' => '', 'body' => '', 'email' => '', 'full_name' => '', 'phone_number' => ''];
            $this->set('contactsInfo', $contactInfo);
        }
        
        $result = $this->commonSave('Contacts', null, $data);
        if(FLAG_TRUE == $result['result_flag']) {
            $this->Flash->success(__('MSG_CONTACT_SEND_SUCCESS'));
        } elseif(FLAG_INVALID === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_INVALID'));
        } elseif(FLAG_FALSE === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_ERROR'));
        }

        $this->set('contacts', $result['full_info']);
    }
    
}
