<?php

namespace AdminManager\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Exception\Exception;

class InfosController extends AdminController
{
    public $paginate = [
    'fields' => [],
    'limit' => 3,
    'order' => [
        'CompaniesInfos.id' => 'asc'
    ]
];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->loadComponent('Paginator');
        $this->set('menu_item', 'INFO');
    }


    public function index($id = null)
    {
        list($limit, $offset) = $this->paging();
        $aryField = [
            'CompaniesInfos.id',
            "CompaniesInfos.title_vi",
            "CompaniesInfos.title_jp",
            'CompaniesInfos.created'
        ];
        $options = ['category_id' => [], 'not_in_id' => FLAG_FALSE, 'fields' => $aryField];
        if (!is_null($id) && '' !== $id) {
            $options['category_id'] = [$id];
        }
        $options['limit'] = $limit;
        $options['offset'] = $offset;
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $newsResult = $tblRegistry->getInfoCommon($options);
        $this->set('newsResult', $newsResult);

    }

    public function form($id = null)
    {
        $data = $this->request->getData();
        $result = $this->commonSave('CompaniesInfos', $id, $data);
        if(FLAG_TRUE == $result['result_flag']) {
            $this->Flash->success(__('MSG_SAVE_SUCCESS', __('NEWS')));
        } elseif(FLAG_INVALID === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_INVALID'));
        } elseif(FLAG_FALSE === $result['result_flag']) {
            $this->Flash->error(__('MSG_SAVE_FAIL', __('NEWS')));
        }
        $this->set('news', $result['full_info']);

    }

}
