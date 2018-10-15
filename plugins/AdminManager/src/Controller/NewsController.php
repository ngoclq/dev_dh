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
            'News.display_flag',
            'News.created'
        ];
        $options = ['category_id' => [], 'not_in_id' => FLAG_FALSE, 'fields' => $aryField];
        if (!is_null($id) && '' !== $id) {
            $options['category_id'] = [$id];
        }
        $options['limit'] = 100;
        $options['offset'] = $offset;
        $options['is_admin'] = FLAG_TRUE;
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

    public function actionAjax()
    {

        if ($this->request->is(['ajax']) && $this->request->isPost()) {
            $this->autoRender = false;
            $this->viewBuilder()->setLayout(false);

            $id = $this->request->getData('id');
            $handle = $this->request->getData('handle');

            $resultJ = json_encode(['result' => '1', 'handle' => $handle, 'id' => $id, 'message' => '']);
            try {
                $news = TableRegistry::get('News');
                $category = $news->get($id);

                if ('hide' == $handle) {
                    $category->display_flag = '0';
                } elseif ('show' == $handle) {
                    $category->display_flag = '1';
                } elseif ('del' == $handle) {
                    $category->delete_flag = '1';
                }

                if ($news->save($category)) {
                    $resultJ = json_encode(['result' => '1', 'handle' => $handle, 'id' => $id, 'message' => __('Your article has been updated.')]);
                } else {
                    $resultJ = json_encode(['result' => '0', 'handle' => $handle, 'id' => $id, 'message' => __('Unable to update your article.')]);
                }

            } catch (RecordNotFoundException $ex) {
                $resultJ = json_encode(['result' => '0', 'handle' => $handle, 'id' => $id, 'message' => __('Khong ton tai record')]);
            } catch (Exception $ex) {
                $resultJ = json_encode(['result' => '0', 'handle' => $handle, 'id' => $id, 'message' => __('Khong ton tai record')]);
            }

            return $this->response->withDisabledCache()->withType('application/json')->withStringBody($resultJ);
        }
    }

}
