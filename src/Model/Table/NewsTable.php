<?php

namespace App\Model\Table;

use Cake\Database\Exception;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class NewsTable extends TableCommon
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('news_category_id')->alphaNumeric('news_category_id')->requirePresence('news_category_id')->notEmpty('title_vi')->requirePresence('title_vi')->notEmpty('title_jp')->requirePresence('title_jp')->notEmpty('body_vi')->requirePresence('body_vi')->notEmpty('body_jp')->requirePresence('body_jp');
        
        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        if(empty($entity->top_flag)) {
            $entity->top_flag = FLAG_FALSE;
        }
        
        if(!empty($entity->top_flag) && empty($entity->order_number)) {
            $entity->order_number = $this->getMaxOrderNumber();
        }
        
        return true;
    }

    public function getTotalArticleByCategory($aryCategoryId = [])
    {
        try {
            $aryNewsArticle = [];
            $condition = [
                'fields' => [
                    'news_category_id' => '`News`.`news_category_id`',
                    'display_flag' => '`News`.`display_flag`',
                    'count' => 'count(`News`.`id`)'
                ],
                'conditions' => [
                    '`News`.`delete_flag`' => FLAG_FALSE,
                    '`NewsCategories`.`delete_flag`' => FLAG_FALSE
                ],
                'group' => '`News`.`news_category_id`, `News`.`display_flag`'
            ];
            if(is_array($aryCategoryId) && count($aryCategoryId)) {
                $condition['conditions'] = [
                    '`News`.`news_category_id` IN ' => $aryCategoryId
                ];
            } elseif(!empty($aryCategoryId)) {
                $condition['conditions'] = [
                    '`News`.`news_category_id`' => $aryCategoryId
                ];
            }
            
            $newsResult = $this->find('all', $condition)->join([
                'NewsCategories' => [
                    'table' => 'news_categories',
                    'type' => 'INNER',
                    'conditions' => '`NewsCategories`.`id` = `News`.`news_category_id`'
                ]
            ])->toArray();
            
            $aryTotal = [
                '0' => FLAG_FALSE,
                '1' => FLAG_FALSE
            ];
            if(!empty($newsResult) && is_array($newsResult)) {
                foreach($newsResult as $key => $newsInfo) {
                    $aryTotal[$newsInfo->display_flag] = (int)$aryTotal[$newsInfo->display_flag] + (int)$newsInfo->count;
                    if(!isset($aryNewsArticle[$newsInfo->news_category_id])) {
                        $infoTmp = [
                            '0' => FLAG_FALSE,
                            '1' => FLAG_FALSE
                        ];
                        $infoTmp[$newsInfo->display_flag] = $newsInfo->count;
                        $aryNewsArticle[$newsInfo->news_category_id] = $infoTmp;
                    } else {
                        $aryNewsArticle[$newsInfo->news_category_id][$newsInfo->display_flag] = $newsInfo->count;
                    }
                }
                $aryNewsArticle['summary'] = $aryTotal;
            }
        } catch(RecordNotFoundException $ex) {
            // Nothing todo
        } catch(Exception $ex) {
            // Nothing todo
        }
        return $aryNewsArticle;
    }

    public function getTotalViewByCategory($aryCategoryId = [])
    {
        try {
            $aryNewsHistory = [];
            $condition = [
                'fields' => [
                    'news_category_id' => '`News`.`news_category_id`',
                    'user_flag' => '`NewsHistories`.`user_flag`',
                    'count' => 'COUNT(`NewsHistories`.`id`)'
                ],
                'conditions' => [
                    '`News`.`delete_flag`' => FLAG_FALSE,
                    '`NewsCategories`.`delete_flag`' => FLAG_FALSE
                ],
                'group' => '`News`.`news_category_id`, `NewsHistories`.`user_flag`'
            ];
            
            if(is_array($aryCategoryId) && count($aryCategoryId)) {
                $condition['conditions'] = [
                    '`News`.`news_category_id` IN ' => $aryCategoryId
                ];
            } elseif(!empty($aryCategoryId)) {
                $condition['conditions'] = [
                    '`News`.`news_category_id`' => $aryCategoryId
                ];
            }
            
            $newsHistoryResult = $this->find('all', $condition)->join([
                'NewsCategories' => [
                    'table' => 'news_categories',
                    'type' => 'INNER',
                    'conditions' => '`NewsCategories`.`id` = `News`.`news_category_id`'
                ],
                'NewsHistories' => [
                    'table' => 'news_histories',
                    'type' => 'INNER',
                    'conditions' => '`News`.`id` = `NewsHistories`.`news_id`'
                ]
            ])->toArray();
            
            $aryTotal = [
                '0' => FLAG_FALSE,
                '1' => FLAG_FALSE
            ];
            if(!empty($newsHistoryResult) && is_array($newsHistoryResult)) {
                foreach($newsHistoryResult as $key => $historyInfo) {
                    $aryTotal[$historyInfo->user_flag] = (int)$aryTotal[$historyInfo->user_flag] + (int)$historyInfo->count;
                    if(!isset($aryNewsHistory[$historyInfo->news_category_id])) {
                        $infoTmp = [
                            '0' => FLAG_FALSE,
                            '1' => FLAG_FALSE
                        ];
                        $infoTmp[$historyInfo->user_flag] = $historyInfo->count;
                        $aryNewsHistory[$historyInfo->news_category_id] = $infoTmp;
                    } else {
                        $aryNewsHistory[$historyInfo->news_category_id][$historyInfo->user_flag] = $historyInfo->count;
                    }
                }
                $aryNewsHistory['summary'] = $aryTotal;
            }
        } catch(RecordNotFoundException $ex) {
            // Nothing todo
        } catch(Exception $ex) {
            // Nothing todo
        }
        return $aryNewsHistory;
    }

    /**
     * get maximum value of `order_number` column then plus 1
     *
     * @return int
     */
    public function getMaxOrderNumber()
    {
        $orderNumber = $this->find('all', [
            'conditions' => [
                'top_flag' => FLAG_TRUE,
                'delete_flag' => FLAG_FALSE
            ],
            'fields' => [
                'order_number' => 'MAX(News.order_number) + 1 '
            ]
        ]);
        
        if($orderNumber->first()->order_number) {
            $maxOrderNumber = $orderNumber->first()->order_number;
        } else {
            $maxOrderNumber = 1;
        }
        
        return $maxOrderNumber;
    }

    public function getNewsCommon($options = ['id' => [], 'category_id' => [], 'not_in_id' => FLAG_FALSE])
    {
        $conditionOptions = [];
        $aryNewsHistory = [];
        if (!isset($options['fields']) || !is_array($options['fields']) || empty($options['fields'])) {
            $condition = [
                'fields' => [
                    'News.id',
                    'News.news_category_id',
                    'title' => "News.title_{$this->language}",
                    'body' => "News.body_{$this->language}",
                    'keyword' => "News.keyword_{$this->language}",
                    'News.user_id',
                    'created' => 'News.date_active',
                    'category_title' => "NewsCategories.title_{$this->language}",
                    'category_description' => "NewsCategories.description_{$this->language}",
                    'category_path' => 'NewsCategories.path',
                    'category_description' => "NewsCategories.description_{$this->language}",
                ]
            ];
        } else {
            $condition = [
                'fields' => $options['fields']
            ];
        }

        $condition['conditions'] = [
            '`News`.`date_active` <= ' => date('y-m-d H:i:s'),
            '`News`.`display_flag`' => FLAG_TRUE,
            '`NewsCategories`.`delete_flag`' => FLAG_FALSE,
            '`NewsCategories`.`display_flag`' => FLAG_TRUE
        ];
        
        if(isset($options['not_in_id']) && $options['not_in_id']) {
            if(isset($options['id']) && is_array($options['id']) && count($options['id'])) {
                $condition['conditions'][ '`News`.`id` NOT IN '] = $options['id'];
            } elseif(isset($options['id']) && !empty($options['id'])) {
                $condition['conditions']['`News`.`id` <>'] = $options['id'];
            }
        } elseif(!isset($options['not_in_id']) || empty($options['not_in_id'])) {
            if(isset($options['id']) && is_array($options['id']) && count($options['id'])) {
                $condition['conditions']['`News`.`id` IN '] =$options['id'];
            } elseif(isset($options['id']) && !empty($options['id'])) {
                $condition['conditions']['`News`.`id`'] = $options['id'];
                $conditionOptions['get_one'] = FLAG_TRUE;
            }
        }
        
        if(isset($options['category_id']) && is_array($options['category_id']) && count($options['category_id'])) {
            $condition['conditions']['`News`.`news_category_id` IN '] = $options['category_id'];
        } elseif(isset($options['category_id']) && !empty($options['category_id'])) {
            $condition['conditions']['`News`.`news_category_id`'] = $options['category_id'];
        }

        if(isset($options['top_flag']) && !is_null($options['top_flag']) && '' !== $options['top_flag']) {
            $condition['conditions']['`News`.`top_flag`'] = $options['top_flag'];
        }

        if (isset($options['conditions']) && is_array($options['conditions'])) {
            $condition['conditions'] = array_merge($condition['conditions'], $options['conditions']);
        }
        if (isset($options['order'])) {
            $condition['order'] = $options['order'];
        } else {
            $condition['order'] = ['`News`.`date_active` DESC', '`News`.`id` DESC'];
        }
        if(isset($options['limit'])) {
            $condition['limit'] = $options['limit'];
        }
        
        $joins = [
            'NewsCategories' => [
                'table' => 'news_categories',
                'type' => 'INNER',
                'conditions' => '`NewsCategories`.`id` = `News`.`news_category_id`'
            ]
        ];
        
        $conditionOptions['type'] = 'all';
        $conditionOptions['options'] = $condition;
        $conditionOptions['joins'] = $joins;
        $conditionOptions['to_array'] = FLAG_TRUE;
        
        return $this->commonFind('News', $conditionOptions);
    }
    
    public function getTopView($options = ['past_days' => 7, 'category_id' => []])
    {
        $conditionOptions = [];
        $aryNewsHistory = [];
        $condition = [
            'fields' => [
                'total' => 'COUNT(News.id)',
                'News.id',
                'News.news_category_id',
                'title' => "News.title_{$this->language}",
                'News.top_flag'
            ],
            'conditions' => [
                '`News`.`date_active` <= ' => date('y-m-d H:i:s'),
                '`News`.`display_flag`' => FLAG_TRUE,
                '`NewsCategories`.`delete_flag`' => FLAG_FALSE,
                '`NewsCategories`.`display_flag`' => FLAG_TRUE
            ],
            'group' => ['`News`.`id`'],
            'order' => ['`News`.`top_flag` DESC', 'total DESC']
        ];
        
        if(isset($options['category_id']) && is_array($options['category_id']) && count($options['category_id'])) {
            $condition['conditions']['`News`.`news_category_id` IN '] = $options['category_id'];
        } elseif(isset($options['category_id']) && !empty($options['category_id'])) {
            $condition['conditions']['`News`.`news_category_id`'] = $options['category_id'];
        }
        
        if (isset($options['past_days']) && $options['past_days']) {
            $date = date('Y-m-d');
            $pastDays = strtotime('-' . $options['past_days'] . ' days', strtotime ($date)) ;
            $pastDays = date('Y-m-d', $pastDays );
            $condition['conditions'][] = ['`NewsHistories`.`created` >= ' => $pastDays];
            $condition['conditions'][] = ['`NewsHistories`.`created` < ' => $date];
        }
        
        $joins = [
            'NewsCategories' => [
                'table' => 'news_categories',
                'type' => 'INNER',
                'conditions' => '`NewsCategories`.`id` = `News`.`news_category_id`'
            ],
            'NewsHistories' => [
                'table' => 'news_histories',
                'type' => 'INNER',
                'conditions' => '`NewsHistories`.`news_id` = `News`.`id`'
            ]
        ];
        
        $conditionOptions['type'] = 'all';
        $conditionOptions['options'] = $condition;
        $conditionOptions['joins'] = $joins;
        $conditionOptions['to_array'] = FLAG_TRUE;
        return $this->commonFind('News', $conditionOptions);
    }

    public function getListNew()
    {
        $sql = "select `news_category_id`, `id`, `date_active`, row_number
from 
(
   select tbl.`news_category_id`, tbl.`id`, tbl.`date_active`,
      (@num:=if(@group = tbl.`news_category_id`, @num +1, if(@group := tbl.`news_category_id`, 1, 1))) row_number 
  from `news` AS tbl
  CROSS JOIN (select @num:=0, @group:=null) AS tbl_cr
	WHERE tbl.`display_flag` = 1 AND `top_flag` = 0
  order by tbl.`news_category_id`, tbl.`date_active` desc
) as x 
where x.row_number <= 20";
        
        
    }





}
