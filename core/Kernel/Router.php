<?php
namespace LexSystems\Framework\Kernel;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Router
 *
 * PHP version 7.0
 */
class Router extends \Buki\Router\Router
{
    /**
     * @param array $params
     * @param Request|null $request
     * @param Response|null $response
     */
    public function __construct(array $params = [], Request $request = null, Response $response = null)
    {
        if(!$params)
        {
            $params = [
                'paths' => [
                    'controllers' => 'Controller',
                    'middlewares' => 'Middleware'
                ],
                'namespaces' => [
                    'controllers' => 'LexSystems\Framework\Controllers',
                    'middlewares' => 'LexSystems\Framework\Middlewares'
                ],
                'debug' => \LexSystems\Framework\Configs\Kernel\Error::ERROR_REPORTING
            ];
        }
        parent::__construct($params, $request, $response);
    }

    /**
     * @param Closure $callback
     */

    public function error(Closure $callback): void
    {
        parent::error(
            function() {
                $system = new System();
                $system->view()->renderTemplate('404',['error' => 'The specified route does not exist.']);
            }
        );
    }
}