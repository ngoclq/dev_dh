<?php


namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once 'Component/Facebook/autoload.php';

class UsersController extends AppController
{
    public $helpers = ['Text'];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    
    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }
    
    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }
    
    public function register()
    {
        $this->set('form_register', FLAG_TRUE);
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
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
        $this->set('user', $user);
        $this -> render('/Users/login');
    }

    public function login()
    {
        $this->set('form_register', FLAG_FALSE);
        $user = $this->Users->newEntity();
        $this->set('user', $user);
        //$this->viewBuilder()->setLayout(FLAG_FALSE);
        if ($this->request->is('post')) {
            $userLogin = $this->Auth->identify();
            if ($userLogin) {
                $this->Auth->setUser($userLogin);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('MSG_LOGIN_ERROR', [__('EMAIL'), __('PASSWORD')]), [
                'key' => 'login'
            ]);
        }
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function loginFacebook()
    {
        $faceInfo = Configure::read('Config.Facebook');
        $fb = new Facebook ([
            'app_id' => $faceInfo['app_id'],
            'app_secret' => $faceInfo['app_secret'],
            'default_graph_version' => 'v2.11',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (! isset($accessToken)) {
            $permissions = array('public_profile','email'); // Optional permissions
            $loginUrl = $helper->getLoginUrl(BASE_URL_HTTP . 'users/login_facebook/', $permissions);
            header("Location: ".$loginUrl);
            exit;
        }
        
        try {
            // Returns a `Facebook\FacebookResponse` object
            $fields = array('id', 'name', 'first_name', 'middle_name', 'last_name', 'email', 'gender', 'locale');
            $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
        } catch(FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        $user = $response->getGraphUser();
        error_log(print_r($user, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_face.txt');
        $result = $this->saveUser($user);
        if (FLAG_TRUE == $result) {
            $this->redirect(['controller' => 'Homes', 'action' => 'home']);
        }
    }

    private function saveUser($aryInfo)
    {
        if (empty($aryInfo)) {
            return FLAG_FALSE;
        }
        
        $existFlag = $this->Users->exists(['face_id' => $aryInfo['id']]);
        if ($existFlag) {
            
            return;
        } else {
            $user = $this->Users->newEntity();
            $userInfo = [];
            $userInfo['face_id'] = $aryInfo['id'];
            $userInfo['first_name'] = __('FORMAT_FIRST_NAME', [$aryInfo['first_name'], $aryInfo['middle_name']]);
            $userInfo['last_name'] = $aryInfo['last_name'];
            $userInfo['username'] = $aryInfo['email'];
            if (isset($aryInfo['gender'])) {
                if ('male' == $aryInfo['gender']) {
                    $userInfo['gender'] = 1;
                } elseif ('female' == $aryInfo['gender']) {
                    $userInfo['gender'] = 0;
                }
                
            }
            
            $userInfo['password'] = $this->generateString();
            $userInfo['password_raw'] = $userInfo['password'];
            $userInfo['role'] = FLAG_TRUE;
            $userInfo['lock_flag'] = FLAG_FALSE;
            $userInfo['locale'] = $this->language;
            $user = $this->Users->patchEntity($user, $userInfo);
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user);
                return FLAG_TRUE;
            }
            
        }
    }

}
