<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\View\Helper\TextHelper;

class NewsController extends AppController
{
    public $helpers = ['Text'];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index($id = null)
    {
        $aryField = [
            'News.id',
            'News.news_category_id',
            'title' => "News.title_{$this->language}",
            'body' => "News.body_{$this->language}",
            'News.created',
            'category_title' => "NewsCategories.title_{$this->language}",
            'category_description' => "NewsCategories.description_{$this->language}",
        ];
        $options = ['category_id' => [], 'not_in_id' => FLAG_FALSE, 'fields' => $aryField];
        if (!is_null($id) && '' !== $id) {
            $options['category_id'] = [$id];
        }
        $tblRegistry = TableRegistry::get('News');
        $newsResult = $tblRegistry->getNewsCommon($options);
        $this->set('newsResult', $newsResult);
    }


    public function detail($id = null)
    {
        $tblRegistry = TableRegistry::get('News');
        $newsInfo = $tblRegistry->getNewsCommon(['id' => $id]);
        if (empty($newsInfo)) {
            $this->Flash->success(__('MSG_IS_NOT_EXIST', __('NEWS')));
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->set('newsInfo', $newsInfo);
        $newsThreadsTbl = TableRegistry::get('NewsThreads');
        $newsThreads = $newsThreadsTbl->newEntity();
        $this->set('newsThreads', $newsThreads);

        // Start Save to news_history
        $historyInfo = [];
        $historyInfo['news_id'] = $id;
        $historyInfo['query'] = '';
        $this->commonSave('NewsHistories', null, $historyInfo, FLAG_TRUE);
        // End Save to news_history
    }


    public function getRelated()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $id = $this->request->getData('id');
        $categoryId = $this->request->getData('categoryId');

        $aryField = [
            'News.id',
            'News.news_category_id',
            'title' => "News.title_{$this->language}",
            'body' => "News.body_{$this->language}",
            'News.created'
        ];
        $options = ['id' => [$id], 'category_id' => [$categoryId], 'not_in_id' => FLAG_TRUE, 'fields' => $aryField];
        $tblRegistry = TableRegistry::get('News');
        $newsResult = $tblRegistry->getNewsCommon($options);
        $linkH = new TextHelper(new \Cake\View\View());
        if (!empty($newsResult)) {
            foreach ($newsResult as $key => $info) {
                $aryImage = [];
                preg_match_all('/<img[^>]+>/i', $info['body'], $aryImgfull);
                if (!empty(array_filter($aryImgfull))) {
                    foreach ($aryImgfull[0] as $keyTmp => $imageInfo) {
                        /* $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $imageInfo, $images);
                         //preg_match_all( '@src="([^"]+)"@' , $imageInfo, $images );
                         $aryImage[] = $images[1][0]; */

                        preg_match_all('/(alt|title|src)=[\'"]([^\'"]+)[\'"].*>/i',$imageInfo, $images);
                        $image = array_fill_keys($images[1], $images[2][0]);
                        $aryImage[] = $image;
                    }

                    $contents = preg_replace("/<img[^>]+\>/i", '', $info['body']);
                }
                /* $newsResult[$key]['body'] = $linkH->truncate($contents, 100);
                error_log(print_r($linkH->truncate($contents, 100), true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug1111111111.txt'); */
                $newsResult[$key]['list_img'] = $aryImage;
            }
            $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
        }

        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }

    /**
     * Lay danh sach bai viet co dinh hiển thị Top
     * @return unknown|\Cake\Http\Response
     */
    public function getTop()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $options = ['past_days' => 7];
        $tblRegistry = TableRegistry::get('News');
        $newsResult = $tblRegistry->getTopView($options);
        if (!empty($newsResult)) {
            $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
        }

        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }

    public function getLatestNews()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $id = $this->request->getData('id');
        $categoryId = $this->request->getData('categoryId');
        $topFlag = $this->request->getData('topFlag');
        $aryField = [
            'News.id',
            'News.news_category_id',
            'title' => "News.title_{$this->language}",
            'News.created'
        ];

        $options = ['id' => [], 'category_id' => [], 'not_in_id' => FLAG_TRUE, 'fields' => $aryField];

        if (!is_null($id) && '' !== $id) {
            $options['id'] = [$id];
        }
        if (!is_null($categoryId) && '' !== $categoryId) {
            $options['category_id'] = $categoryId;
        }
        if (!is_null($topFlag) && '' !== $topFlag) {
            $options['top_flag'] = $topFlag;
        }

        $tblRegistry = TableRegistry::get('News');
        $newsResult = $tblRegistry->getNewsCommon($options);
        if (!empty($newsResult)) {
            $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
        }

        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }

    public function getNewsCategory()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $id = $this->request->getData('id');
        $aryField = [
            'NewsCategories.id',
            'title' => "NewsCategories.title_{$this->language}",
        ];

        $options = ['id' => [], 'not_in_id' => FLAG_FALSE, 'fields' => $aryField];

        if (!is_null($id) && '' !== $id) {
            $options['id'] = [$id];
        }

        $tblRegistry = TableRegistry::get('NewsCategories');
        $newsResult = $tblRegistry->getNewsCategoryCommon($options);
        if (!empty($newsResult)) {
            $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
        }

        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }

    public function sendComment()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $newsId = $this->request->getData('news_id');
        $title = $this->request->getData('title');
        $body = $this->request->getData('body');
        $locale = $this->request->getData('locale');

        // Start Save to news_threads
        $comment = [];
        $comment['news_id'] = $newsId;
        $comment['title'] = $title;
        $comment['body'] = $body;
        $comment['locale'] = $locale;
        $comment['user_id'] = '1';

        $result = $this->commonSave('NewsThreads', null, $comment, FLAG_TRUE);
        error_log(print_r($result, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_result.txt');
        // End Save to news_history
        if (isset($result['id'])) {
            $tblRegistry = TableRegistry::get('NewsThreads');
            $options = ['id' => $result['id'], 'news_id' => [$newsId], 'locale' => $locale, 'not_in_id' => FLAG_FALSE, 'fields' => []];
            $newsResult = $tblRegistry->getNewsThreadsCommon($options);
            if (!empty($newsResult)) {
                $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
            }
            error_log(print_r($result, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_AAAAAAAAAAAAAAAAaa.txt');
        }
        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }

    public function getComment()
    {
        if (!$this->request->is(['ajax'])) {
            return $this->redirect([
                'controller' => 'News',
                'action' => 'index',
                '_method' => 'GET'
            ]);
        }
        $this->autoRender = FLAG_FALSE;
        $this->viewBuilder()->setLayout(FLAG_FALSE);

        $result = ['result' => FLAG_FALSE, 'data' => []];
        $newsId = $this->request->getData('news_id');
        $locale = $this->request->getData('locale');

        $options = ['news_id' => [$newsId], 'locale' => $locale, 'not_in_id' => FLAG_FALSE, 'fields' => []];

        $tblRegistry = TableRegistry::get('NewsThreads');
        $newsResult = $tblRegistry->getNewsThreadsCommon($options);
        if (!empty($newsResult)) {
            $result = ['result' => FLAG_TRUE, 'data' => $newsResult];
        }
        error_log(print_r($newsResult, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_comment.txt');
        return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
    }
}
