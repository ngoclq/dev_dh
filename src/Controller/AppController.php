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

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use Cake\Routing\DispatcherFactory;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\I18n\I18n;
use Cake\I18n\Middleware\LocaleSelectorMiddleware;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /*public $helpers = array(
    );*/
    var $language = DEFAULT_LANGUAGE;
    var $Session = null;
    public $paginate = [
        'limit' => 30,
    ];

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
        $this->Session = $this->request->getSession();

        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->viewBuilder()->setLayout('default_blog');
        //$this->viewBuilder()->setLayout('default_ping');

        $this->getMenuCategory();

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->loadComponent('Paginator');

        // Start Modify
        /* if ($this->request->getParam('language')) {
            Configure::write('Config.language', $this->request->getParam('language'));
        } */

        DispatcherFactory::add('LocaleSelector');

        // Restrict the locales to only vi, jp
        DispatcherFactory::add('LocaleSelector', [
            'locales' => [
                'vi',
                'jp'
            ]
        ]);

        $languageAccept = array_keys(Configure::read('Config.languageAccept'));
        $this->language = Configure::read('Config.language');
        if (empty($this->language) || !in_array($this->language, $languageAccept)) {
            $this->language = $this->request->getQuery('language');
        }

        if (empty($this->language) || !in_array($this->language, $languageAccept)) {
            $this->language = DEFAULT_LANGUAGE;
        }

        $this->set('language', $this->language);
        I18n::setLocale($this->language);
        // End Modify

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Homes',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Homes',
                'action' => 'home',
                'home'
            ],
            //'authError' => 'Loi 1',
            //'loginError' => 'Loi 2',
            /* 'authenticate' => [
                'Form' => [
                    'passwordHasher' => [
                        'className' => 'Simple',
                        'hashType' => 'md5'
                    ],
                    'userModel' => 'Users',
                    'fields' => [
                        'username' => 'login_id',
                        'password' => 'password'
                    ],
                    //'scope' => ['User.is_active' => 1],
                    'recursive' => 0,
                    'contain' => null
                ]
            ] */
        ]);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->authError = __('BBBBBBB.');
        $this->Auth->loginError = __('AAAAAAAAA.');
        $this->Auth->allow();
        $this->Auth->deny(['contact']);
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
    // Start Modify
    /*  public function redirect($url, $status = null, $exit = true) {
         parent::redirect(router_url_language($url), $status, $exit);
     }

     public function flash($message, $url, $pause = 1) {
         parent::flash($message, router_url_language($url), $pause);
     } */
    // End Modify

    public function upload()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout(false);
        try {
            $uploadData = '';
            if ($this->request->is('post')) {
                $resultJ = json_encode([
                    'link' => ''
                ]);
                if (!empty($this->request->getData('upload')['name'])) {
                    $fileName = $this->request->getData('upload')['name'];
                    $fileType = $this->request->getData('upload')['type'];
                    $fileExtTmp = explode(".", $fileName);
                    $fileExt = end($fileExtTmp);
                    $strUnique = md5(date("Y-m-d-H-i-s") . '--' . microtime(true) . '--' . $fileName);
                    $uploadPath = '/uploads/files/';
                    $filePath = $uploadPath . $strUnique . '.' . $fileExt;
                    $uploadFile = dirname(APP) . '/webroot' . $filePath;
                    if (move_uploaded_file($this->request->getData('upload')['tmp_name'], $uploadFile)) {
                        $filesTbl = TableRegistry::get('Files');
                        $files = $filesTbl->newEntity();
                        $files->hash = $strUnique;
                        $files->name = $fileName;
                        $files->type = $fileType;
                        $files->size = $this->request->getData('upload')['size'];
                        $files->path = $uploadFile;
                        if ($filesTbl->save($files)) {
                            $urlDownload = Router::url([
                                'controller' => 'App',
                                'action' => 'download',
                                $files->hash
                            ]);
                            $resultJ = json_encode([
                                'uploaded' => true,
                                'url' => $filePath
                            ]);
                            return $this->response->withDisabledCache()->withType('application/json')->withStringBody($resultJ);
                        } else {
                            $file = new File($uploadFile);
                            $file->delete();
                            throw new \Exception('Lưu thông tin file không thành công');
                        }
                    } else {
                        throw new \Exception('Upload file không thành công');
                    }
                } else {
                    throw new \Exception('File không tồn tại');
                }
            }
        } catch (\ErrorException $ex) {
            $result[] = 'Có lỗi xảy ra';
            $resultJ = json_encode([
                'uploaded' => false,
                'error' => [
                    "message" => "could not upload this image"
                ]
            ]);
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody($resultJ);
        }
    }

    public function uploadFroala()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout(false);
        try {
            $uploadData = '';
            if ($this->request->is('post')) {
                $resultJ = json_encode([
                    'link' => ''
                ]);
                if (!empty($this->request->getData('file')['name'])) {
                    $fileName = $this->request->getData('file')['name'];
                    $fileType = $this->request->getData('file')['type'];
                    $fileExtTmp = explode(".", $fileName);
                    $fileExt = end($fileExtTmp);
                    $strUnique = md5(date("Y-m-d-H-i-s") . '--' . microtime(true) . '--' . $fileName);
                    $uploadPath = '/var/www/DEV_JP/webroot/uploads/files/';
                    $uploadFile = $uploadPath . $strUnique . '.' . $fileExt;
                    if (move_uploaded_file($this->request->getData('file')['tmp_name'], $uploadFile)) {
                        $filesTbl = TableRegistry::get('Files');
                        $files = $filesTbl->newEntity();
                        $files->hash = $strUnique;
                        $files->name = $fileName;
                        $files->type = $fileType;
                        $files->size = $this->request->getData('file')['size'];
                        $files->path = $uploadFile;
                        if ($filesTbl->save($files)) {
                            $urlDownload = Router::url([
                                'controller' => 'App',
                                'action' => 'download',
                                $files->hash
                            ]);
                            $resultJ = json_encode([
                                'link' => $urlDownload
                            ]);
                            return $this->response->withDisabledCache()->withType('application/json')->withStringBody($resultJ);
                        } else {
                            $file = new File($uploadFile);
                            $file->delete();
                            throw new \Exception('Lưu thông tin file không thành công');
                        }
                    } else {
                        throw new \Exception('Upload file không thành công');
                    }
                } else {
                    throw new \Exception('File không tồn tại');
                }
            }
        } catch (\ErrorException $ex) {
            $result[] = 'Có lỗi xảy ra';
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody($result);
        }
    }

    public function download($id = null)
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout(false);
        $result = [
            'success' => '1'
        ];
        try {
            if (empty($id)) {
                return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
            }
            $conditions = [
                'conditions' => [
                    'hash' => $id
                ]
            ];
            $filesTbl = TableRegistry::get('Files');
            $fileInfo = $filesTbl->find('all', $conditions)->first();
            return $this->response->withFile($fileInfo->path, array(
                'download' => true,
                'name' => $fileInfo->name
            ));
        } catch (RecordNotFoundException $ex) {
            $result[] = 'Không tồn tại file';
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
        } catch (Exception $ex) {
            $result[] = 'Có lỗi xảy ra';
            return $this->response->withDisabledCache()->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function commonFind($table, $options = ['type' => 'all', 'joins' => [], 'options' => [], 'get_one' => FLAG_FALSE, 'count' => FLAG_FALSE, 'to_array' => FLAG_FALSE])
    {
        try {
            $aryResult = [
                'result_flag' => '',
                'full_info' => '',
                'msg' => ''
            ];

            $tblRegistry = TableRegistry::get($table);
            $table = strtoupper($table);

            if (!isset($options['type']) || empty($options['type'])) {
                $options['type'] = 'all';
            }

            if (!isset($options['joins']) || empty($options['joins']) || !is_array($options['joins'])) {
                $options['joins'] = [];
            }

            $query = $tblRegistry->find($options['type'], $options['options'])->join($options['joins']);
            if (isset($options['get_one']) && $options['get_one']) {
                $query = $query->first();
            }

            if (isset($options['count']) && $options['count']) {
                $query = $query->count();
            }

            if (isset($options['to_array']) && $options['to_array']) {
                $query = $query->toArray();
            }

            $aryResult = [
                'result_flag' => FLAG_TRUE,
                'full_info' => $query,
                'msg' => ''
            ];
        } catch (RecordNotFoundException $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'full_info' => '',
                'msg' => __('MSG_IS_NOT_EXIST', __($table))
            ];
        } catch (Exception $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'full_info' => '',
                'msg' => __('MSG_EXCEPTION', __($table))
            ];
        }

        return $aryResult;
    }

    public function commonSave($table, $primaryKey = null, $data, $autoSave = FLAG_FALSE)
    {
        try {
            $aryResult = [
                'result_flag' => '',
                'id' => '',
                'full_info' => '',
                'msg' => ''
            ];
            $tblRegistry = TableRegistry::get($table);
            $table = strtoupper($table);
            if ($primaryKey) {
                $tblInfo = $tblRegistry->get($primaryKey);
            } else {
                $tblInfo = $tblRegistry->newEntity();
            }

            if ($autoSave || $this->request->is([
                    'post',
                    'put'
                ])) {
                $tblInfo = $tblRegistry->patchEntity($tblInfo, $data);
                if ($tblRegistry->save($tblInfo)) {
                    $id = $tblInfo->id;
                    $aryResult = [
                        'result_flag' => FLAG_TRUE,
                        'id' => $id,
                        'full_info' => $tblInfo,
                        'msg' => __('MSG_SAVE_SUCCESS', __($table))
                    ];
                } else {
                    $aryResult = [
                        'result_flag' => FLAG_FALSE,
                        'id' => $primaryKey,
                        'full_info' => $tblInfo,
                        'msg' => __('MSG_SAVE_FAIL', __($table))
                    ];
                }

                if ($tblInfo->errors()) {
                    $aryResult['result_flag'] = FLAG_INVALID;
                }
            } else {
                $aryResult = [
                    'result_flag' => '',
                    'id' => $primaryKey,
                    'full_info' => $tblInfo,
                    'msg' => ''
                ];
            }
        } catch (RecordNotFoundException $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'id' => '',
                'full_info' => '',
                'msg' => __('MSG_IS_NOT_EXIST', __($table))
            ];
        } catch (Exception $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'id' => '',
                'full_info' => '',
                'msg' => __('MSG_EXCEPTION', __($table))
            ];
        }

        return $aryResult;
    }

    public function commonUpdateAll($table, $data, $autoSave = FLAG_FALSE)
    {
        try {
            $aryResult = [
                'result_flag' => '',
                'msg' => ''
            ];
            $tblRegistry = TableRegistry::get($table);

            if ($autoSave || $this->request->is([
                    'post',
                    'put'
                ])) {
                $result = $tblRegistry->updateAll(
                    $data['fields'],
                    $data['conditions']
                );
                if ($result) {
                    $aryResult = [
                        'result_flag' => FLAG_TRUE,
                        'msg' => __('MSG_SAVE_SUCCESS', __($table))
                    ];
                }
            } else {
                $aryResult = [
                    'result_flag' => '',
                    'msg' => ''
                ];
            }
        } catch (RecordNotFoundException $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'msg' => __('MSG_IS_NOT_EXIST', __($table))
            ];
        } catch (Exception $ex) {
            $aryResult = [
                'result_flag' => FLAG_FALSE,
                'msg' => __('MSG_EXCEPTION', __($table))
            ];
        }

        return $aryResult;
    }

    public function getListCategory($displayFlag = '', $getParent = false)
    {
        try {
            $data = [];
            $conditions = [
                'fields' => [
                    'id',
                    'parent_id',
                    'title_vi',
                    'title_jp',
                    'description_vi',
                    'description_jp',
                    'order_number',
                    'display_flag',
                    'created'
                ],
                'order' => [
                    'parent_id' => 'ASC',
                    'order_number' => 'ASC'
                ]
            ];

            if (!is_null($displayFlag) && '' !== $displayFlag) {
                $conditions['conditions']['display_flag'] = $displayFlag;
            }

            if ($getParent) {
                $conditions['conditions']['parent_id'] = 0;
            }

            $conditions['conditions']['delete_flag'] = 0;

            $newsCategory = TableRegistry::get('NewsCategories');
            $data = $newsCategory->find('all', $conditions);
        } catch (\ErrorException $ex) {
            $data = [];
        }

        return $data;
    }

    public function getMenuCategory()
    {
        /*if ($this->Session->check('categories')) {
            $this->set('categories', $this->Session->read('categories'));
            return;
        }*/

        $categories = $this->getListCategory(1);
        $aryCategory = [];
        $otherId = '99999999';
        $index = 1;
        foreach ($categories as $key => $info) {
            if ($index <= 5 || isset($aryCategory[$info->parent_id])) {
                if (isset($aryCategory[$info->parent_id])) {
                    $aryCategory[$info->parent_id]['children'][$info->id] = ['id' => $info->id, 'title' => $info->{'title_' . $this->language}];
                } else {
                    $index++;
                    $aryCategory[$info->id] = ['id' => $info->id, 'title' => $info->{'title_' . $this->language}];
                }
            } else {
                $aryCategory[$otherId]['children'][$info->id] = ['id' => $info->id, 'title' => $info->{'title_' . $this->language}];
            }
        }

        if (isset($aryCategory[$otherId])) {
            $aryCategory[$otherId]['id'] = '';
            $aryCategory[$otherId]['title'] = __('MENU_OTHER');
        }

        $this->Session->write('categories', $aryCategory);
        $this->set('categories', $aryCategory);

    }

    public function setMenubar($aryMenu = [])
    {
        $aryInfo = [];
        if (isset($aryMenu) && is_array($aryMenu) && count($aryMenu)) {
            foreach ($aryMenu as $info) {
                $aryInfo[$info['id']] = $info['title'];
            }
        }

        $this->set('menuPath', $aryInfo);
    }

    public function generateString($s_length = 8)
    {
        $lower_case = "abcdefghijklmnopqrstuvwxyz";
        $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $num = "0123456789";
        $char_list = [$lower_case, $upper_case, $num];
        $check = FLAG_FALSE;
        while (!$check) {
            $check_list = [0, 0, 0];
            $i = 0;
            $result = "";
            $tmp = "";
            while ($i < $s_length) {
                $type = mt_rand(0, count($char_list) - 1);
                $char = $char_list[$type][mt_rand(0, strlen($char_list[$type]) - 1)];
                if ($char == $tmp) {
                    continue;
                }
                $tmp = $char;
                $result .= $char;
                $check_list[$type] = $check_list[$type] + 1;
                $i++;
            }
            if (min($check_list) > 0) {
                $check = FLAG_TRUE;
            }
        }
        return $result;
    }

    public function parserImg($str)
    {
        if (empty($str) || is_array($str)) {
            return ['str_content' => '', 'images' => []];
        }

        $contents = '';
        $aryImage = [];
        preg_match_all('/<img[^>]+>/i', $str, $aryImgfull);
        if (!empty(array_filter($aryImgfull))) {
            foreach ($aryImgfull[0] as $keyTmp => $imageInfo) {
                /* $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $imageInfo, $images);
                 //preg_match_all( '@src="([^"]+)"@' , $imageInfo, $images );
                 $aryImage[] = $images[1][0]; */

                preg_match_all('/(alt|title|src)=[\'"]([^\'"]+)[\'"].*>/i', $imageInfo, $images);
                $image = array_fill_keys($images[1], $images[2][0]);
                $aryImage[] = $image;
            }
        }

        $contents = preg_replace("/<img[^>]+\>/i", '', $str);
        return ['str_contents' => $contents, 'images' => $aryImage];
    }

    public function paging()
    {
        $page = (int)$this->request->getQuery('page', 1);
        if (empty($page) || $page < 1) {
            $page = 1;
        }

        $limit = RECORD_ONCE_PAGE;
        if (empty($limit) || $limit < 0) {
            $limit = 10;
        }

        $offset = 0;
        if ($page) {
            $offset = ($page - 1) * $limit;
        }

        return [$limit, $offset];
    }
}
