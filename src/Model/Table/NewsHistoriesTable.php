<?php
namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class NewsHistoriesTable extends TableCommon
{
    public function initialize(array $config)
    {
        // Nothing todo
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
        ->notEmpty('news_id')
        ->alphaNumeric('news_id')
        ->requirePresence('news_id');
        
        return $validator;
    }
    
    
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);

        return true;
    }
    
}