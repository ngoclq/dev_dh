<?php

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class NewsThreadsTable extends TableCommon
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('body')->requirePresence('body');
        
        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        if(empty($entity->top_flag)) {
            $entity->top_flag = FLAG_FALSE;
        }
        
        return true;
    }

    public function getNewsThreadsCommon($options = ['id' => [], 'not_in_id' => FLAG_FALSE])
    {
        $conditionOptions = [];
        $aryNewsHistory = [];
        if(!isset($options['fields']) || !is_array($options['fields']) || empty($options['fields'])) {
            $condition = [
                'fields' => [
                    'NewsThreads.id',
                    'NewsThreads.news_id',
                    'NewsThreads.title',
                    'NewsThreads.body',
                    'NewsThreads.user_id',
                    'Users.first_name',
                    'Users.last_name',
                    'NewsThreads.created'
                ]
            ];
        } else {
            $condition = [
                'fields' => $options['fields']
            ];
        }
        
        $condition['conditions'] = [
            '`NewsThreads`.`display_flag`' => FLAG_TRUE,
            '`Users`.`display_flag`' => FLAG_TRUE,
            '`Users`.`delete_flag`' => FLAG_FALSE
        ];
        
        if(isset($options['id']) && is_array($options['id']) && count($options['id'])) {
            $condition['conditions']['`NewsThreads`.`id` IN '] = $options['id'];
        } elseif(isset($options['id']) && !empty($options['id'])) {
            $condition['conditions']['`NewsThreads`.`id`'] = $options['id'];
            if (isset($options['get_one'])) {
                $conditionOptions['get_one'] = $options['get_one'];
            }
        }
        
        if(isset($options['news_id']) && is_array($options['news_id']) && count($options['news_id'])) {
            $condition['conditions']['`NewsThreads`.`news_id` IN '] = $options['news_id'];
        } elseif(isset($options['news_id']) && !empty($options['news_id'])) {
            $condition['conditions']['`NewsThreads`.`news_id`'] = $options['news_id'];
        }
        
        if(isset($options['locale']) && $options['locale']) {
            $condition['conditions']['`NewsThreads`.`locale`'] = $options['locale'];
        }
        
        $joins = [
            'Users' => [
                'table' => 'users',
                'type' => 'INNER',
                'conditions' => '`Users`.`id` = `NewsThreads`.`user_id`'
            ]
        ];
        
        $conditionOptions['type'] = 'all';
        $conditionOptions['options'] = $condition;
        $conditionOptions['joins'] = $joins;
        $conditionOptions['to_array'] = FLAG_TRUE;

        return $this->commonFind('NewsThreads', $conditionOptions);
    }
}