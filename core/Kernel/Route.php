<?php
namespace LexSystems\Framework\Core\Kernel;
use LexSystems\Framework\Core\Kernel\Router;
class Route
{
    /**
     * @var Route
     */
    private static $instance;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * @return Route
     */
    private static function getSingleton()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function get(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->get($route,$controller,$opts);
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function post(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->post($route,$controller,$opts);
    }


    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function put(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->put($route,$controller,$opts);
    }


    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function delete(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->delete($route,$controller,$opts);
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function patch(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->patch($route,$controller,$opts);
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function getMiddlewares()
    {
        self::getSingleton()->router->getMiddlewares();
    }


    public static function getRoutes()
    {
        self::getSingleton()->router->getRoutes();
    }

    /**
     * @param string $prefix
     * @param Closure $callback
     * @param array $opts
     */
    public static function group(string $prefix = '', Closure $callback , array $opts = [])
    {
        self::getSingleton()->router->group($prefix, $callback, $opts);
    }


    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function xdelete(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->xdelete($route,$controller,$opts);
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function xput(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->xput($route,$controller,$opts);
    }

    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function xpatch(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->xpatch($route, $controller, $opts);
    }


    /**
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function xpost(string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->xpatch($route, $controller, $opts);
    }

    /**
     * @param string $methods
     * @param string $route
     * @param string $controller
     * @param array $opts
     */
    public static function add(string $methods = 'GET|POST', string $route = '', string $controller = '', array $opts = [])
    {
        self::getSingleton()->router->add($methods, $route ,$controller, $opts);
    }

    /**
     * Dispatch router
     */
    public static function dispatch()
    {
       self::getSingleton()->router->run();
    }
}