<?php

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class CompaniesInfosTable extends TableCommon
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title_vi')->requirePresence('title_vi')
            ->notEmpty('title_jp')->requirePresence('title_jp')
            ->notEmpty('body_vi')->requirePresence('body_vi')
            ->notEmpty('body_jp')->requirePresence('body_jp');

        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);

        return true;
    }


}
