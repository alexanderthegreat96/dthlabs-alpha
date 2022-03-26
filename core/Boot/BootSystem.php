<?php
namespace LexSystems\Framework\Core\Boot;
use LexSystems\Framework\Config\Kernel\Maintenance;
use LexSystems\Framework\Core\Autoloader;
use function Siler\Http\redirect;

require __DIR__.'/../Autoloader.php';
require __DIR__."/LoadClasses.php";
require  __DIR__."/../Errors/ErrorHandler.php";
require __DIR__."/../Errors/ShutdownHandler.php";
require __DIR__."/../Errors/ExceptionHandler.php";
require __DIR__."/PackageManager.php";
require __DIR__."/Facade.php";
require  __DIR__."/Eloquent.php";
require  __DIR__."/Env.php";
require __DIR__ . '/Maintenance.php';

class BootSystem
{
    /**
     * Boot constructor
     */
    public function __construct()
    {
        /**
         * Register shutdown handler
         * I hate the default php error
         * output
         */
        register_shutdown_function('shutdownHandler');

        /**
         * Load the rest of the classes
         */

        LoadClasses::boot();

        /**
         * Load configuration files
         */

        Autoloader::load(__DIR__ . '/../../config/');

        /**
         * Handle erros internally
         */
        error_reporting(E_ALL);
        set_error_handler('\LexSystems\Framework\Core\Errors\ErrorHandler::errorHandler');
        set_exception_handler('\LexSystems\Framework\Core\Errors\ExceptionHandler::exceptionHandler');


        /**
         * Boot facade
         */

        Facade::boot();

        /**
         * Boot eloquent and facades
         */

        Eloquent::boot();

        /**
         * Boot framework packages
         */

        $packages = new PackageManager();
        $packages->boot();

        /**
         * Env load
         * $_ENV
         */

            Env::boot();

        /**
         * check if system is under heavy maintainance
         */

        \LexSystems\Framework\Core\Boot\Maintenance::init();

    }
}