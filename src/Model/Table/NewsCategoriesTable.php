<?php
namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class NewsCategoriesTable extends TableCommon
{

    public function initialize(array $config)
    {
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title_vi')
            ->requirePresence('title_vi')
            ->notEmpty('title_jp')
            ->requirePresence('title_jp');
        
        return $validator;
    }

    function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        if (empty($entity->order_number)) {
            $entity->order_number = $this->getMaxOrderNumber();
        }
        
        return true;
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
                'delete_flag' => FLAG_FALSE
            ],
            'fields' => [
                'order_number' => 'MAX(NewsCategories.order_number) + 1 '
            ]
        ]);
        
        if ($orderNumber->first()->order_number) {
            $maxOrderNumber = $orderNumber->first()->order_number;
        } else {
            $maxOrderNumber = 1;
        }
        
        return $maxOrderNumber;
    }
    
    public function getNewsCategoryCommon($options = ['id' => [], 'not_in_id' => FLAG_FALSE])
    {
        $conditionOptions = [];
        $aryNewsHistory = [];
        if (!isset($options['fields']) || !is_array($options['fields']) || empty($options['fields'])) {
            $condition = [
                'fields' => [
                    'NewsCategories.id',
                    'title' => "NewsCategories.title_{$this->language}",
                    'description' => "NewsCategories.description_{$this->language}",
                    'NewsCategories.path'
                ]
            ];
        } else {
            $condition = [
                'fields' => $options['fields']
            ];
        }
        
        $condition['conditions'] = [
            '`NewsCategories`.`display_flag`' => FLAG_TRUE,
            '`News`.`display_flag`' => FLAG_TRUE,
            '`News`.`delete_flag`' => FLAG_FALSE
        ];

        if (isset($options['conditions']) && is_array($options['conditions'])) {
            $condition['conditions'] = array_merge($condition['conditions'], $options['conditions']);
        }
        $condition['group'] = ['`NewsCategories`.`id`'];
        $condition['order'] = ['`NewsCategories`.`parent_id` ASC', '`NewsCategories`.`order_number` ASC'];
        
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
        if(isset($options['limit'])) {
            $condition['limit'] = $options['limit'];
        }
        
        $joins = [
            'News' => [
                'table' => 'news',
                'type' => 'INNER',
                'conditions' => '`NewsCategories`.`id` = `News`.`news_category_id`'
            ]
        ];

        $conditionOptions['type'] = 'all';
        $conditionOptions['options'] = $condition;
        $conditionOptions['joins'] = $joins;
        $conditionOptions['to_array'] = FLAG_TRUE;
        
        return $this->commonFind('NewsCategories', $conditionOptions);
    }
    

}