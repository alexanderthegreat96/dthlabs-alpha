<?php

require __DIR__ . '/../../vendor/autoload.php';

$params = [
    'debug' => true,
    'paths' => [
        'controllers' => __DIR__ . '/Controllers',
        'middlewares' => __DIR__ . '/Middlewares',
    ],
    'namespaces' => [
        'controllers' => 'Buki\\Tests\\Example\\Controllers',
        'middlewares' => 'Buki\\Tests\\Example\\Middlewares',
    ],
    'base_folder' => __DIR__,
    'main_method' => 'main',
];

$router = new \Buki\Router\Router($params);

$router->get('/', function() {
    return 'Hello World!';
}, ['before' => 'TestMiddleware:burak,30']);

$router->get('/test', 'TestController@main');
$router->get('/test2', ['TestController', 'main']);
$router->get('/invoke', 'FooController');

$router->controller('/controller', 'TestController');

$router->run();
