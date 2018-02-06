<?php

namespace App\Model\Table;

use Cake\Database\Expression\IdentifierExpression;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class ContactsTable extends TableCommon
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title')->notEmpty('body')->notEmpty('email')->notEmpty('full_name');
        
        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        if(empty($entity->root_id)) {
            $entity->root_id = FLAG_FALSE;
        }
        
        if(empty($entity->parent_id)) {
            $entity->parent_id = FLAG_FALSE;
        }
        
        if(empty($entity->read_flag)) {
            $entity->read_flag = FLAG_FALSE;
        }
        
        if(empty($entity->answer_flag)) {
            $entity->answer_flag = FLAG_FALSE;
        }
        
        if(empty($entity->to_delete_flag)) {
            $entity->to_delete_flag = FLAG_FALSE;
        }
        if(empty($entity->hash)) {
            $entity->hash = $this->generateHashKey();
        }
        if(isset($entity->body)) {
            $entity->body = htmlspecialchars($entity->body);
        }
        if(empty($entity->locale)) {
            $entity->locale = $this->language;
        }
        
        return true;
    }

    /**
     * get hash key does not exist in DB
     *
     * @return string length is 40 character
     */
    public function generateHashKey()
    {
        $val = '';
        $existFlag = FLAG_FALSE;
        do {
            $val = $this->generateString(48);
            $existFlag = $this->exists(['hash' => $val]);
        } while (FLAG_TRUE == $existFlag);
        
        return $val;
    }
    
    public function getContactByHash($hash)
    {
        $listing = $this->find()
        ->where(function (QueryExpression $exp) {
            $cast = $this
            ->query()
            ->func()
            ->cast([
                new IdentifierExpression('hash'),
                'BINARY' => '34I271m7C2q0AjD74tSJFePkCDSa3ve7VFPqd5f0oKF7FtC8'
            ])
            ->tieWith(' AS AAAAAAAa');
            
            return $exp->eq($cast, '34I271m7C2q0AjD74tSJFePkCDSa3ve7VFPqd5f0oKF7FtC8');
        });
    }





}
