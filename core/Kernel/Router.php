<?php
namespace LexSystems\Framework\Kernel;
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
                ],
                'namespaces' => [
                    'controllers' => 'LexSystems\Framework\Controllers',
                ],
                'debug' => \LexSystems\Framework\Configs\Kernel\Error::ERROR_REPORTING
            ];
        }
        parent::__construct($params, $request, $response);
    }
}