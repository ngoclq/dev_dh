<?php

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class ArticlesTable extends TableCommon
{

    public function initialize(array $config)
    {
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('article_category_id')->alphaNumeric('article_category_id')->requirePresence('article_category_id')->notEmpty('title_vi')->requirePresence('title_vi')->notEmpty('title_jp')->requirePresence('title_jp')->notEmpty('body_vi')->requirePresence('body_vi')->notEmpty('body_jp')->requirePresence('body_jp');
        
        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        if(empty($entity->top_flag)) {
            $entity->top_flag = 0;
        }
        
        if(!empty($entity->top_flag) && empty($entity->order_number)) {
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
                'top_flag' => FLAG_TRUE,
                'delete_flag' => FLAG_FALSE
            ],
            'fields' => [
                'order_number' => 'MAX(Articles.order_number) + 1 '
            ]
        ]);
        
        if($orderNumber->first()->order_number) {
            $maxOrderNumber = $orderNumber->first()->order_number;
        } else {
            $maxOrderNumber = 1;
        }
        
        return $maxOrderNumber;
    }
}