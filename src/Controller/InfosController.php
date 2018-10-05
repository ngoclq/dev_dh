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

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => $id
            ],
            'fields' => [
                'body' => "body_{$this->language}",
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
            'fields' => [
                'body' => "body_{$this->language}",
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function vision()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 2
            ],
            'fields' => [
                'body' => "body_{$this->language}",
            ],
        ])->first();
        $this->set('info', $info);
    }

    public function privacy()
    {
        $tblRegistry = TableRegistry::get('CompaniesInfos');

        $info = $tblRegistry->find('all', [
            'conditions' => [
                'id' => 3
            ],
            'fields' => [
                'body' => "body_{$this->language}",
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
            'fields' => [
                'body' => "body_{$this->language}",
            ],
        ])->first();
        $this->set('info', $info);
    }


}
