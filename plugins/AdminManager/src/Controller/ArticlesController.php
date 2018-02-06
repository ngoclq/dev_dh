<?php

namespace AdminManager\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Exception\Exception;

class ArticlesController extends AdminController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $listCategory = $this->_getListCategory();
        $this->set('articlesCategory', $listCategory);
        if(!empty($listCategory)) {
            $articlesTbl = TableRegistry::get('Articles');
            $condition = [
                'fields' => [
                    'article_category_id',
                    'display_flag',
                    'count' => 'count(`id`)'
                ],
                'conditions' => [
                    'delete_flag' => '0'
                ],
                'group' => '`article_category_id`, `display_flag`'
            ];
            
            $aryArticles = $articlesTbl->find('all', $condition);
            // error_log(print_r([$aryArticles, $listCategory], true) . "\n\n============\n", 3, '/var/www/DEV_JP/logs/debug_article.txt');
            $aryData = [];
            foreach($listCategory as $index => $info) {
                // $info->set($key)
                error_log(print_r([
                    $info
                ], true) . "\n\n============\n", 3, '/var/www/DEV_JP/logs/debug_article.txt');
            }
        }
    }

    /**
     *
     * @param int $id
     */
    public function list($id = null)
    {
        error_log(print_r("Runni111ng", true), 3, '/var/www/DEV_JP/logs/debug.txt');
    }

    public function form($id = null)
    {
        try {
            $articlesTbl = TableRegistry::get('Articles');
            if($id) {
                $articles = $articlesTbl->get($id);
            } else {
                $articles = $articlesTbl->newEntity();
            }
            
            if($this->request->is([
                'post',
                'put'
            ])) {
                $articlesTbl->patchEntity($articles, $this->request->getData());
                if($articlesTbl->save($articles)) {
                    $id = $articles->id;
                    $this->Flash->success(__('MSG_SAVE_SUCCESS', __('NEWS')));
                    return $this->redirect([
                        'controller' => 'Articles',
                        'action' => 'index',
                        '_method' => 'GET',
                        'plugin' => 'AdminManager'
                    ]);
                }
                
                $this->Flash->error(__('MSG_SAVE_FAIL', __('ARTICLES')));
            }
            
            $this->set('articles', $articles);
            
            $article_category_id = $this->_getListCategoryFillComboxBox(1);
            $this->set(compact('article_category_id'));
            $this->set('_serialize', [
                'article_category_id'
            ]);
        } catch(RecordNotFoundException $ex) {
            $this->Flash->error(__('MSG_IS_NOT_EXIST', __('ARTICLES')));
            return $this->redirect([
                'controller' => 'Articles',
                'action' => 'index',
                '_method' => 'GET',
                'plugin' => 'AdminManager'
            ]);
        } catch(Exception $ex) {
            $this->Flash->error(__('MSG_EXCEPTION', __('ARTICLES')));
            return $this->redirect([
                'controller' => 'Articles',
                'action' => 'index',
                '_method' => 'GET',
                'plugin' => 'AdminManager'
            ]);
        }
    }

    private function _getListCategory($displayFlag = '')
    {
        try {
            $data = [];
            $conditions = [
                'fields' => [
                    'id',
                    'title_vi',
                    'title_jp',
                    'description_vi',
                    'description_jp',
                    'order_number',
                    'display_flag'
                ],
                'order' => [
                    'order_number' => 'ASC'
                ]
            ];
            
            if(!is_null($displayFlag) && '' !== $displayFlag) {
                $conditions ['conditions'] = [
                    'display_flag' => $displayFlag
                ];
            }
            
            $articlesCategory = TableRegistry::get('ArticlesCategories');
            $data = $articlesCategory->find('all', $conditions);
        } catch(\ErrorException $ex) {
            $data = [];
        }
        
        return $data;
    }

    private function _getListCategoryFillComboxBox($displayFlag = '')
    {
        $data = [];
        $listCategory = $this->_getListCategory($displayFlag);
        if(empty($listCategory)) {
            return $data;
        }
        foreach($listCategory as $key => $info) {
            $data [$info->id] = $info->title_vi;
        }
        
        return $data;
    }
}
