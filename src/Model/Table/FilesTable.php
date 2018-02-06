<?php
namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class FilesTable extends TableCommon
{
    public function initialize(array $config)
    {
        // Nothing todo
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
        ->notEmpty('name')
        ->requirePresence('name')
        ->notEmpty('paths')
        ->requirePresence('paths')
        ->notEmpty('size')
        ->requirePresence('size');
        
        return $validator;
    }
    
    
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        return true;
    }
    
    
    
}