<?php
use LexSystems\Framework\Core\Kernel\Router;
/**
 * Routing done through php-router
 */

$router = new Router();

/**
 * Routes go bellow
 */

//$router->get('/test','TestController@index');
$router->get('/', 'MyController@index');
$router->get('/login', 'Login@index',['after' => 'AfterAuth']);
$router->post('/login/try', 'Login@try',['after' => 'AfterAuth']);
//$router->post('/store', 'IndexController@store');
//$router->get('/edit/:id', 'IndexController@edit');
//$router->put('/update/:id', 'IndexController@update');
//$router->delete('/delete/:id', 'IndexController@delete');

$router->run();
