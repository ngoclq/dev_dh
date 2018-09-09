<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin('AdminManager', [
    'path' => '/admin'
], function (RouteBuilder $routes) {
    $routes->get('/', [
        'controller' => 'Home',
        'action' => 'home'
    ]);

    // Article top
    $routes->get('/articles/', [
        'controller' => 'Articles',
        'action' => 'index'
    ]);

    // Article top
    $routes->connect('/articles/add', [
        'controller' => 'Articles',
        'action' => 'form'
    ]);

    // Article detail
    $routes->connect('/articles/:id', [
        'controller' => 'Articles',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // List Article by category
    $routes->get('/articles/list/:id', [
        'controller' => 'Articles',
        'action' => 'list'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // List Category of Article
    $routes->connect('/articles/category', [
        'controller' => 'ArticlesCategory',
        'action' => 'index'
    ]);
    /* Start ArticlesCategory Area */
    // Detail/Edit category
    $routes->connect('/articles/category/add', [
        'controller' => 'ArticlesCategory',
        'action' => 'form'
    ]);

    // Detail/Edit category
    $routes->connect('/articles/category/:id', [
        'controller' => 'ArticlesCategory',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // Delete/Show/Hide category
    $routes->connect('/articles/category/actionAjax', [
        'controller' => 'ArticlesCategory',
        'action' => 'actionAjax'
    ]);
    /* End ArticlesCategory Area */

    /* Start News Area */
    // News top
    $routes->get('/news/', [
        'controller' => 'News',
        'action' => 'index'
    ]);

    // List News by category
    $routes->get('/news/list/:id', [
        'controller' => 'News',
        'action' => 'index'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // News add
    $routes->connect('/news/add', [
        'controller' => 'News',
        'action' => 'form'
    ]);

    // News detail
    $routes->connect('/news/:id', [
        'controller' => 'News',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // List Category of News
    $routes->connect('/news/category', [
        'controller' => 'NewsCategory',
        'action' => 'index'
    ]);
    /* End News Area */

    /* Start Site Info Area */
    // Info top
    $routes->get('/info/', [
        'controller' => 'Infos',
        'action' => 'index'
    ]);
    // Info detail
    $routes->connect('/info/:id', [
        'controller' => 'Infos',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])
        ->setPass(['id']);
    /* End Site Info Area */

    /* Start NewsCategory Area */
    // Detail/Edit category
    $routes->connect('/news/category/add', [
        'controller' => 'NewsCategory',
        'action' => 'form'
    ]);

    // Detail/Edit category
    $routes->connect('/news/category/:id', [
        'controller' => 'NewsCategory',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])
    ->setPass(['id']);

    // Delete/Show/Hide category
    $routes->connect('/news/category/actionAjax', [
        'controller' => 'NewsCategory',
        'action' => 'actionAjax'
    ]);
    /* End NewsCategory Area */


    /* START CONTACTS AREA */
    $routes->get('/contacts/', [
        'controller' => 'Contacts',
        'action' => 'index'
    ]);
    $routes->get('/contacts/detail/:id', [
        'controller' => 'Contacts',
        'action' => 'detail'
    ])->setPatterns(['id' => '[a-z0-9_]+'])->setPass(['id']);
    $routes->connect('/contacts/form/:id', [
        'controller' => 'Contacts',
        'action' => 'form'
    ])->setPatterns(['id' => '\d+'])->setPass(['id']);
    $routes->connect('/contacts/red/', [
        'controller' => 'Contacts',
        'action' => 'actionEditRedFlag'
    ]);
    $routes->connect('/contacts/delete/', [
        'controller' => 'Contacts',
        'action' => 'actionDelete'
    ]);
    /* END CONTACTS AREA */

});
