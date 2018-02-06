<?php

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;
use ArrayObject;

class UsersTable extends TableCommon
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        // Nothing todo
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('first_name', __('MSG_NOT_EMPTY', __('FIRST_NAME')))->requirePresence('first_name', __('MSG_NOT_EMPTY', __('FIRST_NAME')));
        $validator->notEmpty('last_name', __('MSG_NOT_EMPTY', __('LAST_NAME')))->requirePresence('last_name', __('MSG_NOT_EMPTY', __('LAST_NAME')));
        
        $validator->add('username', [
            'validEmail' => [
                'rule' => [
                    'email'
                ],
                'message' => __('MSG_EMAIL_INVALID')
            ],
            /* 'unique' => [
                'message' => __('MSG_EMAIL_EXIST'),
                'provider' => 'users',
                'rule' => 'validateUnique'
            ] */
        ])->requirePresence('username', 'create', __('MSG_NOT_EMPTY', __('EMAIL')))->notEmpty('username', __('MSG_NOT_EMPTY', __('EMAIL')));
        
        $validator->add('password', [
            'minLength' => [
                'rule' => [
                    'minLength',
                    6
                ],
                'message' => __('MSG_MIN_LENGTH', __('PASSWORD'), '6')
            ]
        ])->requirePresence('password', 'create', __('MSG_NOT_EMPTY', __('PASSWORD')))->notEmpty('password', __('MSG_NOT_EMPTY', __('PASSWORD')));
        
        $validator->requirePresence('password_raw', 'create', __('MSG_NOT_EMPTY', __('PASSWORD_RAW')))->notEmpty('password_raw', __('MSG_NOT_EMPTY', __('PASSWORD_RAW')))
        ->add('password_raw', 'custom', [
            'rule' => function ($value, $context) {
                if(isset($context['data']['password']) && $value == $context['data']['password']) {
                    return true;
                }
                return false;
            },
            'message' => __('MSG_PASSWORD_NOT_MATCH')
        ]);
        
        /*
         *
         *
         * ->notEmpty('gender')->requirePresence('gender')
         * ->notEmpty('dob')->requirePresence('dob')
         * ->notEmpty('mobile')->requirePresence('mobile')
         * ->notEmpty('avatar_path')->requirePresence('avatar_path')
         * ->notEmpty('locale')->requirePresence('locale');
         */
        
        return $validator;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        parent::beforeSave($event, $entity, $options);
        
        return true;
    }
    
    /* public function validateUnique($email)
    {
        error_log(print_r($email, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_email.txt');
        return $this->exists(['username' => $email]);
    } */
    
    public function saveUser()
    {
        
        $this->request->withParam('role', '1');
        $this->request->withParam('locale', $this->language);
        $this->request->withParam('lock_flag', '0');
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));
            return $this->redirect(['controller' => 'Homes', 'action' => 'home']);
        }
        $this->Flash->error(__('MSG_REGISTER_ERROR'), [
            'key' => 'register'
        ]);
    }
}