<?php
namespace AdminManager\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Exception\Exception;

class ArticlesCategoryController extends AdminController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $this->loadModel('ArticlesCategories');
        $data = $this->ArticlesCategories->find('all');
        $this->set('articles', $data);
    }

    public function form($id = null)
    {
        $result = $this->commonSave('ArticlesCategories', $id, $this->request->getData());
        if(isset($result['msg']) && $result['msg']) {
            $this->Flash->success($result['msg']);
        }
        if(isset($result['full_info']) && $result['full_info']) {
            $this->set('articleCategory', $result['full_info']);
        }
        
        if ($result['result_flag'] || !isset($result['full_info']) || empty($result['full_info'])) {
            return $this->redirect([
                'controller' => 'ArticlesCategory',
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
                $articlesCategory = TableRegistry::get('ArticlesCategories');
                $category = $articlesCategory->get($id);

                if ('hide' == $handle) {
                    $category->display_flag = '0';
                } elseif ('show' == $handle) {
                    $category->display_flag = '1';
                } elseif ('del' == $handle) {
                    $category->delete_flag = '1';
                }

                if ($articlesCategory->save($category)) {
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
