<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace AdminManager\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AdminController extends AppController
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        //$this->viewBuilder()->setLayout('AdminManager.admin_layout');
        $this->viewBuilder()->setLayout('AdminManager.admin');
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->getListContact();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        //$this->Security->setConfig('blackHoleCallback', 'blackhole');
        return null;
    }
    
    public function blackhole($type)
    {
        error_log(print_r("Runninggggggggggg", true), 3, '/var/www/DEV_JP/logs/debug123.txt');
        // Handle errors.
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production.
        // You should instead set "_serialize" in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    private function getListContact()
    {
        
        $options = [];
        $options['fields'] = [
            'Contacts.id',
            'root_id_tmp' => 'IF(root_id = 0, id, root_id)',
            'Contacts.full_name',
            'Contacts.created'
        ];
        $options['conditions'] = ['to_delete_flag' => FLAG_FALSE, 'read_flag' => FLAG_FALSE];
        $options['group'] = ['root_id_tmp'];
        $options['limit'] = 3;
        $result = $this->commonFind('Contacts', ['options' => $options]);
        $this->set('new_contact_header', $result['full_info']);
        
        unset($options['limit']);
        $resultCount = $this->commonFind('Contacts', ['options' => $options, 'count' => FLAG_TRUE]);
        $this->set('new_contact_unread', $resultCount['full_info']);
    }
}
