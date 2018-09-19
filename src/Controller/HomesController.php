<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class HomesController extends AppController
{

    public function home()
    {
        /* Get Top */
        $aryField = [
            'News.id',
            'News.news_category_id',
            'title' => "News.title_{$this->language}",
            'body' => "News.body_{$this->language}",
        ];
        $options = [
            'conditions' => ['top_flag' => FLAG_TRUE],
            'category_id' => [],
            'not_in_id' => FLAG_FALSE,
            'fields' => $aryField,
            'order' => 'rand()',
            'limit' => '5'
        ];
        $tblRegistry = TableRegistry::get('News');
        $newsTop = $tblRegistry->getNewsCommon($options);
         foreach ($newsTop as $key => $news) {
            $aryTmp = $this->parserImg($news['body']);
            $newsTop[$key]['body'] = $aryTmp['str_contents'];
            $newsTop[$key]['image'] = isset($aryTmp['images'][0]) ? $aryTmp['images'][0]['src'] : NEWS_DEFAULT_IMG;
        }

        $this->set('newsTop', $newsTop);


        $aryNews = [];
        $tblNewsCateRegistry = TableRegistry::get('NewsCategories');
        $newsCateResult = $tblNewsCateRegistry->getNewsCategoryCommon();
        if (is_array($newsCateResult)) {
            foreach ($newsCateResult as $key => $newsCate) {
                $aryField = [
                    'News.id',
                    'News.news_category_id',
                    'title' => "News.title_{$this->language}",
                    'body' => "News.body_{$this->language}",
                ];
                $options = [
                    'conditions' => ['top_flag' => FLAG_TRUE],
                    'category_id' => [$newsCate['id']],
                    'not_in_id' => FLAG_FALSE,
                    'fields' => $aryField,
                    'order' => ['News.id DESC'],
                    'limit' => $newsCate['number_display_top']
                ];
                $tblRegistry = TableRegistry::get('News');
                $newsEachCate = $tblRegistry->getNewsCommon($options);
                if (count($newsEachCate)) {
                    foreach ($newsEachCate as $key => $news) {
                        $aryTmp = $this->parserImg($news['body']);
                        $newsEachCate[$key]['body'] = $aryTmp['str_contents'];
                        $newsEachCate[$key]['image'] = isset($aryTmp['images'][0]) ? $aryTmp['images'][0]['src'] : NEWS_DEFAULT_IMG;
                    }
                    $aryNews[] = [
                        'id' => $newsCate['id'],
                        'title' => $newsCate['title'],
                        'description' => $newsCate['description'],
                        'list' => $newsEachCate
                    ];
                }
            }

            $this->set('aryNews', $aryNews);
        }

        /* Get Top */

        /* $newsTbl = TableRegistry::get('News');
         $newsResult = $newsTbl->getNewsCommon();
         if (empty($newsResult)) {
         $this->Flash->success(__('Khong ton tai record'));
         }
         foreach ($newsResult as $key => $info) {
         $aryImage = [];
         preg_match_all('/<img[^>]+>/i', $info['body'], $aryImgfull);
         if (!empty(array_filter($aryImgfull))) {
         foreach ($aryImgfull[0] as $keyTmp => $imageInfo) {
         preg_match_all('/(alt|title|src)=[\'"]([^\'"]+)[\'"].*>/i',$imageInfo, $images);
         $image = array_fill_keys($images[1], $images[2][0]);
         $aryImage[] = $image;
         }

         $contents = preg_replace("/<img[^>]+\>/i", '', $info['body']);
         $newsResult[$key]['body'] = $contents;
         }
         $newsResult[$key]['list_img'] = $aryImage;
         }

         $this->set('newsResult', $newsResult); */
    }
}
