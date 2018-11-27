<?php
namespace AdminManager\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Exception\Exception;

class NewsCategoryController extends AdminController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->set('menu_item', 'NEWS');
    }

    /* public function index()
    {
        $this->loadModel('NewsCategories');
        $data = $this->NewsCategories->find('all');
        $this->set('news', $data);
    } */

    public function index()
    {
        $listCategory = $this->getListCategory()->toArray(); // Get all category in system
        if(!empty($listCategory)) {
            $newsTbl = TableRegistry::get('News');
            $aryNewsArticle = $newsTbl->getTotalArticleByCategory(); // Get total article with each category
            $aryNewsHistory = $newsTbl->getTotalViewByCategory(); // Get total view article with each category

            foreach($listCategory as $index => $info) {
                if(isset($aryNewsArticle [$info->id])) {
                    $info->set('article_number', $aryNewsArticle [$info->id]);
                } else {
                    $info->set('article_number', [
                        '0' => '0',
                        '1' => '0'
                    ]);
                }

                if(isset($aryNewsHistory [$info->id])) {
                    $info->set('view_number', $aryNewsHistory [$info->id]);
                } else {
                    $info->set('view_number', [
                        '0' => '0',
                        '1' => '0'
                    ]);
                }
                $listCategory [$index] = $info;
            }

            if(isset($aryNewsArticle ['summary'])) {
                $listCategory ['article_total'] = $aryNewsArticle ['summary'];
            }

            if(isset($aryNewsHistory ['summary'])) {
                $listCategory ['view_total'] = $aryNewsHistory ['summary'];
            }
        }
        $this->set('newsCategory', $listCategory);
    }

    public function form($id = null)
    {
        $news_category_id = $this->_getListCategoryFillComboxBox(1);
        $this->set(compact('news_category_id'));
        $data = $this->request->getData();
        $data['parent_id'] = (empty($data['parent_id'])) ? 0 : $data['parent_id'];

        $result = $this->commonSave('NewsCategories', $id, $data);
        if(isset($result['msg']) && $result['msg']) {
            $this->Flash->success($result['msg']);
        }
        if(isset($result['full_info']) && $result['full_info']) {
            $this->set('newsCategory', $result['full_info']);
        }

        if ($result['result_flag'] || !isset($result['full_info']) || empty($result['full_info'])) {
            return $this->redirect([
                'controller' => 'NewsCategory',
                'action' => 'index',
                '_method' => 'GET',
                'plugin' => 'AdminManager'
            ]);
        }
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
                $newsCategory = TableRegistry::get('NewsCategories');
                $category = $newsCategory->get($id);

                if ('hide' == $handle) {
                    $category->display_flag = '0';
                } elseif ('show' == $handle) {
                    $category->display_flag = '1';
                } elseif ('del' == $handle) {
                    $category->delete_flag = '1';
                }

                if ($newsCategory->save($category)) {
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

    private function _getListCategoryFillComboxBox($displayFlag = '')
    {
        $data = [];
        $listCategory = $this->getListCategory($displayFlag, true);
        if(empty($listCategory)) {
            return $data;
        }
        foreach($listCategory as $key => $info) {
            $data [$info->id] = $info->title_vi;
        }

        return $data;
    }


}
