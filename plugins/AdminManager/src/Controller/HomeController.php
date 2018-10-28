<?php
namespace AdminManager\Controller;
use Cake\ORM\TableRegistry;


class HomeController extends AdminController
{
    public function home()
    {
        // Nothing Todo
    }

    public function logout()
    {

        $this->autoRender = false;
        $this->viewBuilder()->setLayout(FLAG_FALSE);
        $this->redirect($this->Auth->logout());
    }

    public function login()
    {
        $this->viewBuilder()->setLayout(FLAG_FALSE);
        $userRegistry = TableRegistry::get('Users');
        $user = $userRegistry->newEntity();
        $this->set('user', $user);
        if ($this->request->is('post')) {
            $userLogin = $this->Auth->identify();
            if ($userLogin) {
                $this->Auth->setUser($userLogin);
                return $this->redirect([
                    'controller' => 'Home',
                    'action' => 'home',
                    '_method' => 'GET',
                    'plugin' => 'AdminManager'
                ]);
            }
            $this->Flash->error(__('MSG_LOGIN_ERROR', [__('EMAIL'), __('PASSWORD')]), [
                'key' => 'login'
            ]);
        }
    }
}
