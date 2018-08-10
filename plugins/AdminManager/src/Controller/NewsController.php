<?php

namespace AdminManager\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Exception\Exception;

class NewsController extends AdminController
{
    public $paginate = [
    'fields' => [],
    'limit' => 3,
    'order' => [
        'News.id' => 'asc'
    ]
];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->loadComponent('Paginator');
        $this->set('menu_item', 'NEWS');
    }


    public function index($id = null)
    {
        list($limit, $offset) = $this->paging();
        $aryField = [
            'News.id',
            'News.news_category_id',
            "News.title_vi",
            "News.title_jp",
            'News.created'
                    ];
        $options = ['category_id' => [], 'not_in_id' => FLAG_FALSE, 'fields' => $aryField];
        if (!is_null($id) && '' !== $id) {
            $options['category_id'] = [$id];
        }
        $options['limit'] = $limit;
        $options['offset'] = $offset;
        $tblRegistry = TableRegistry::get('News');
        $newsResult = $tblRegistry->getNewsCommon($options);
        $this->set('newsResult', $newsResult);



        /* $tblRegistry = TableRegistry::get('News');
        $query = $tblRegistry->find('all');
        $this->set('newsResult', $this->paginate($query)); */
    }

    public function form($id = null)
    {
        $aryHour = range(0, 23);
        $aryMinute = range(0, 59);
        $data = $this->request->getData();
        /* if (isset($data['date_active'])) {
            $data['date_active'] = $data['date_active']['day'] . ' ' . $data['date_active']['time'];
        } else {
            $data['date_active'] = date('Y-m-d H:i:s');
        } */
        $result = $this->commonSave('News', $id, $data);
        if(FLAG_TRUE == $result['result_flag']) {
            $this->Flash->success(__('MSG_SAVE_SUCCESS', __('NEWS')));
        } elseif(FLAG_INVALID === $result['result_flag']) {
            $this->Flash->error(__('MSG_CONTACT_SEND_INVALID'));
        } elseif(FLAG_FALSE === $result['result_flag']) {
            $this->Flash->error(__('MSG_SAVE_FAIL', __('NEWS')));
        }
        $this->set('news', $result['full_info']);

        $news_category_id = $this->_getListCategoryFillComboxBox(1);
        $this->set(compact('news_category_id'));
        $this->set('aryHour', $aryHour);
        $this->set('aryMinute', $aryMinute);

    }

    private function _getListCategoryFillComboxBox($displayFlag = '')
    {
        $data = [];
        $listCategory = $this->getListCategory($displayFlag);
        if(empty($listCategory)) {
            return $data;
        }
        foreach($listCategory as $key => $info) {
            $data [$info->id] = $info->title_vi;
        }

        return $data;
    }
}
