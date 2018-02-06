<?php

namespace AdminManager\Controller;


use Cake\ORM\TableRegistry;

class ContactsController extends AdminController
{
    public $paginate = [
    'fields' => [],
    'limit' => 10,
    'order' => [
        'News.id' => 'asc'
    ]
];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->loadComponent('Paginator');
        $this->loadComponent('Mail');
        $this->set('menu_item', 'CONTACTS');
    }

    /**
     * Hien thi danh sach lien he
     */
    public function index()
    {
        $options = [];
        $options['fields'] = [
            'Contacts.id',
            'root_id_tmp' => 'IF(root_id = 0, id, root_id)',
            'count_sub_id' => 'COUNT(Contacts.id)',
            'Contacts.full_name',
            'Contacts.email',
            'Contacts.title',
            'read_flag' => 'MIN(Contacts.read_flag)',
            'red_flag' => 'MAX(Contacts.red_flag)',
            'created' => 'MAX(Contacts.created)'
        ];
        $options['conditions'] = ['to_delete_flag' => FLAG_FALSE, 'from_admin_flag' => FLAG_FALSE];
        $options['group'] = ['root_id_tmp'];
        $options['order'] = ['created' => 'DESC'];
        $tblRegistry = TableRegistry::get('Contacts');
        $query = $tblRegistry->find('all', $options);
        $this->set('contactsResult', $this->paginate($query));
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
                'OR' => ['id' => $id, 'root_id' => $id]
            ],
        ];
        
        $contactsResult = $this->commonFind('Contacts', $options);
        $this->set('contactsResult', $contactsResult['full_info']);

        if (FLAG_TRUE == $contactsResult['result_flag']) {
            $options['fields']['read_flag'] = FLAG_TRUE;
            $options['conditions'] = [
                'OR' => ['id' => $id, 'root_id' => $id]
            ];
            $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
        }
        
    }
    

    public function form($id = null)
    {
        $aryField = [
            'Contacts.id',
            'Contacts.root_id',
            'Contacts.full_name',
            'Contacts.email',
            "Contacts.title",
            "Contacts.body",
            'Contacts.read_flag',
            'Contacts.red_flag',
            'Contacts.created'
        ];
        $options = ['id' => [], 'not_in_id' => FLAG_FALSE, 'get_one' => FLAG_TRUE];
        $options['options'] = [
            'fields' => $aryField,
            'conditions' => [
                'id' => $id
            ],
        ];
        
        $contactsResult = $this->commonFind('Contacts', $options);
        $this->set('contactsInfo', $contactsResult['full_info']);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            unset($data['id']);
            $data['root_id'] = $id;
            $data['parent_id'] = $id;
            $data['from_admin_flag'] = FLAG_TRUE;
            $data['full_name'] = $contactsResult['full_info']->full_name;
            if (isset($contactsResult['full_info']->root_id) && $contactsResult['full_info']->root_id) {
                $data['root_id'] = $contactsResult['full_info']->root_id;
            }

            $result = $this->commonSave('Contacts', null, $data);
            if(FLAG_TRUE == $result['result_flag']) {
                $this->Flash->success(__('MSG_CONTACT_SEND_SUCCESS'));
                $options['fields']['answer_flag'] = FLAG_TRUE;
                $options['conditions'] = [
                    'id' => $id
                ];
                $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
                
                //$this->Mail->sendMail('abc@example.com');
            } elseif(FLAG_INVALID === $result['result_flag']) {
                $this->Flash->error(__('MSG_CONTACT_SEND_INVALID'));
            } elseif(FLAG_FALSE === $result['result_flag']) {
                $this->Flash->error(__('MSG_CONTACT_SEND_ERROR'));
            }
        } else {
            if (FLAG_TRUE == $contactsResult['result_flag']) {
                $options['fields']['read_flag'] = FLAG_TRUE;
                $options['conditions'] = [
                    'OR' => ['id' => $id, 'root_id' => $id]
                ];
                $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
            }
        }
    }
    
    public function reply()
    {
        
        $data = $this->request->getData();
        $result = $this->commonSave('Contacts', null, $data);
        if(FLAG_TRUE == $result['result_flag']) {
            $this->Flash->success(__('MSG_CONTACT_SEND_SUCCESS'));
        } elseif(FLAG_INVALID === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_INVALID'));
        } elseif(FLAG_FALSE === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_ERROR'));
        }
    }

    
    public function actionEditRedFlag()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'Home',
                'action' => 'home',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);
        
        $result = ['result' => FLAG_FALSE, 'message' => ''];
        $id = $this->request->getData('id');
        $type = $this->request->getData('type', '');
        if (empty($id) || !in_array($type, [FLAG_FALSE, FLAG_TRUE])) {
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
        }
        
        $options = [];
        if (FLAG_TRUE == $type) {
            $options['fields']['red_flag'] = FLAG_TRUE;
            $options['conditions'] = [
                'id' => $id
            ];
        } elseif (FLAG_FALSE == $type) {
            $options['fields']['red_flag'] = FLAG_FALSE;
            $options['conditions'] = [
                'OR' => ['id' => $id, 'root_id' => $id]
            ];
        }
        
        $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
        $result = ['result' => $resultFlag['result_flag'], 'message' => $resultFlag['msg']];
        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }
    
    public function actionDelete()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'Home',
                'action' => 'home',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);
        
        $result = ['result' => FLAG_FALSE, 'message' => ''];
        $id = $this->request->getData('id');
        if (empty($id)) {
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
        }
        
        $options = [];
        $options['fields']['to_delete_flag'] = FLAG_TRUE;
        $options['fields']['delete_flag'] = FLAG_TRUE;
        $options['conditions'] = [
            'OR' => ['id' => $id, 'root_id' => $id]
        ];
        
        $resultFlag = $this->commonUpdateAll('Contacts', $options, FLAG_TRUE);
        $result = ['result' => $resultFlag['result_flag'], 'message' => $resultFlag['msg']];
        
        $aryField = [
            'Contacts.id'
        ];
        $options = ['id' => [], 'not_in_id' => FLAG_FALSE];
        $options['options'] = [
            'fields' => $aryField,
            'conditions' => [
                'OR' => ['id' => $id, 'root_id' => $id]
            ],
        ];
        
        $contactsResult = $this->commonFind('Contacts', $options);
        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }
    

    
}
