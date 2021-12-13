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

        /**
         * Bind custom error templates to the system
         */

        $this->error(function() {

            if(\LexSystems\Framework\Configs\Kernel\Error::ERROR_REPORTING)
            {
                throw new \Exception('The requested route was not found!');
            }
            else
            {
                $system = new System();
                $system->view()->render('404.html');
            }

        });
    }


}