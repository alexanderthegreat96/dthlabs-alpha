<?php
namespace LexSystems\Framework\Core\Kernel;
use LexSystems\Framework\Config\App\Config;
use LexSystems\Framework\Config\Kernel\Error;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Buki\Router\Router as BaseRouter;
/**
 * Router extension for
 * \Buki\Router\Router
 *
 */
class Router extends BaseRouter
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
                    'controllers' => 'Controllers',
                    'middlewares' => 'Middlewares'
                ],
                'namespaces' => [
                    'controllers' => 'App\Controllers',
                    'middlewares' => 'App\Middlewares'
                ],
                'base_folder' => Config::APP_LOCATION,
                'debug' => Error::ERROR_REPORTING
            ];
        }

        parent::__construct($params, $request, $response);

        /**
         * Bind custom error templates to the system
         */

        $this->notFound(function()
        {
            if(Error::ERROR_REPORTING)
            {
                throw new \Exception('The requested route was not found!');
            }
            else
            {
                View::renderTemplate('404.html');
            }
        });

        $this->error(function() {
            if(Error::ERROR_REPORTING)
            {
                throw new \Exception('Something went wrong!');
            }
            else
            {
                View::renderTemplate('500.html');
            }
        });

    }
}