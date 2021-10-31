<?php
use LexSystems\Framework\Kernel;
use LexSystems\Framework\Routes;
use LexSystems\Framework\Kernel\Router;
/**
 * Routing
 */
$router = new Router([
    'paths' => [
        'controllers' => 'Controller',
    ],
    'namespaces' => [
        'controllers' => 'LexSystems\Framework\Controllers',
    ],
    'debug' => \LexSystems\Framework\Configs\Kernel\Error::ERROR_REPORTING
]);

$router->get('/', 'MyControllerr@main');
# OR
# $router->get('/', ['IndexController', 'main']);
# OR
# $router->get('/', [IndexController::class, 'main']);

// other examples...
$router->get('/create', ['MyController','indexAction']);
$router->post('/store', 'IndexController@store');
$router->get('/edit/:id', 'IndexController@edit');
$router->put('/update/:id', 'IndexController@update');
$router->delete('/delete/:id', 'IndexController@delete');

$router->run();