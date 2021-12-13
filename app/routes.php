<?php
use LexSystems\Framework\Kernel\Router;
/**
 * Routing done through php-router
 */

$router = new Router();

/**
 * Routes go bellow
 */

$router->get('/', 'MyController@index',['before' => 'BeforeAuth','after' => 'AfterAuth']);
$router->get('/login', 'Login@index',['after' => 'AfterAuth']);
$router->post('/store', 'IndexController@store');
$router->get('/edit/:id', 'IndexController@edit');
$router->put('/update/:id', 'IndexController@update');
$router->delete('/delete/:id', 'IndexController@delete');

$router->run();
