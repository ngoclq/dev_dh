<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

// Start Modify
$schema = '/';
$filer = [];
$language = DEFAULT_LANGUAGE;
$uri = $_SERVER['REQUEST_URI'];
if(!empty($uri) && mb_strlen($uri) > 1) {
    $aryTmp = explode('/', $uri);
    $functionException = Configure::read('Config.functionException');
    if(isset($aryTmp[1]) && mb_strlen($aryTmp[1]) == 2 && !in_array($aryTmp[1], $functionException)) {
        $language = $aryTmp[1];
        $languageAccept = array_keys(Configure::read('Config.languageAccept'));
        if($language) {
            $schema = '/:language/';
            $filer = [
                'language' => implode('|', $languageAccept)
            ];
        }

        if(!in_array($language, $languageAccept)) {
            $language = DEFAULT_LANGUAGE;
        }
    }
}

Configure::write('Config.language', $language);
// End Modify

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::addUrlFilter(function ($params, $request) {
    $languageAccept = array_keys(Configure::read('Config.languageAccept'));
    if(isset($request->params['language']) && !isset($params['language']) && in_array($request->params['language'], $languageAccept)) {
        $params['language'] = $request->params['language'];
    } elseif(!isset($params['language']) || !in_array($params['language'], $languageAccept)) {
        $params['language'] = DEFAULT_LANGUAGE;
    }

    return $params;
});

Router::scope($schema, $filer, function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', [
        'controller' => 'Homes',
        'action' => 'home'
    ]);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', [
        'controller' => 'Pages',
        'action' => 'display'
    ]);

    $routes->connect('/upload', [
        'controller' => 'App',
        'action' => 'upload'
    ]);
    $routes->connect('/download/:id', [
        'controller' => 'App',
        'action' => 'download'
    ])->setPatterns([
        'id' => '[a-z0-9]+'
    ])->setPass([
        'id'
    ]);

    // News top
    $routes->get('/news/', [
        'controller' => 'News',
        'action' => 'index'
    ]);

    // News detail
    $routes->connect('/news/:id', [
        'controller' => 'News',
        'action' => 'index'
    ])->setPatterns([
        'id' => '\d+'
    ])->setPass([
        'id'
    ]);

    // News detail
    $routes->connect('/news/detail/:id', [
        'controller' => 'News',
        'action' => 'detail'
    ])->setPatterns([
        'id' => '\d+'
    ])->setPass([
        'id'
    ]);

    // Related News
    $routes->connect('/news/related', [
        'controller' => 'News',
        'action' => 'getRelated'
    ]);

    // Top ranking News
    $routes->connect('/news/top', [
        'controller' => 'News',
        'action' => 'getTop'
    ]);

    // Lastest News
    $routes->connect('/news/latest', [
        'controller' => 'News',
        'action' => 'getLatestNews'
    ]);

    // Lastest News
    $routes->connect('/news/category', [
        'controller' => 'News',
        'action' => 'getNewsCategory'
    ]);

    // post News
    $routes->connect('/news/comment', [
        'controller' => 'News',
        'action' => 'sendComment'
    ]);
    // Lastest News
    $routes->connect('/news/list_comment', [
        'controller' => 'News',
        'action' => 'getComment'
    ]);

    // Contacts
    $routes->connect('/contacts/detail/:id', [
        'controller' => 'Contacts',
        'action' => 'detail'
    ])->setPass([
        'id'
    ]);
    $routes->connect('/contacts/:id', [
        'controller' => 'Contacts',
        'action' => 'form'
    ])->setPass([
        'id'
    ]);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
