<?php
use LexSystems\Framework\Kernel;
use LexSystems\Framework\Routes;
/**
 * Routing
 */
$router = new Kernel\Router();
$routes = Routes::returnRoutes();
if($routes)
{
    foreach($routes as $r)
    {
        $router->add($r['route'],['controller' => $r['controller'],'action' => $r['action']]);
    }
}
$router->dispatch($_SERVER['QUERY_STRING']);

