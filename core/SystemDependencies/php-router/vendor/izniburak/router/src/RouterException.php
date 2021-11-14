<?php

namespace Buki\Router;

use Exception;
use LexSystems\Framework\Kernel\System;
class RouterException
{
    /**
     * @var bool $debug Debug mode
     */
    public static $debug = false;

    /**
     * Create Exception Class.
     *
     * @param string $message
     *
     * @param int    $statusCode
     *
     * @throws Exception
     */
    public function __construct(string $message, int $statusCode = 500)
    {
        http_response_code($statusCode);
        if (self::$debug) {
            throw new Exception($message, $statusCode);
        }
        if(file_exists(__DIR__.'/../../../../../../../resources/views/'.$statusCode.'.blade.php'))
        {
           $view = new System();
           $view->view()->renderTemplate($statusCode);
        }
        else
        {
            die("<style>body{background-color: #0073e6; color: #fff; font-family : arial; font-size: 15px;}</style><h2>Opps! An error occurred.</h2> {$message}");
        }

    }
}
