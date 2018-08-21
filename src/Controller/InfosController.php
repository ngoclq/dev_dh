<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\View\Helper\TextHelper;

class InfosController extends AppController
{
    public $helpers = ['Text'];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index($id = null)
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $tblRegistry->find();

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => $id
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function about()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $tblRegistry->find();

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 1
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function vision()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $tblRegistry->find();

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 2
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function privacy()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $tblRegistry->find();

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 3
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function groups()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');
        $tblRegistry->find();

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 4
            ],
        ])->first();
        $this->set('info', $info);
    }


}
