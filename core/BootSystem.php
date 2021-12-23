<?php
namespace LexSystems\Framework\Boot;
use LexSystems\Framework\Kernel\PackageManager;
require 'Autoloader.php';
require "LoadClasses.php";
require "Errors/ErrorHandler.php";
require "Errors/ShutdownHandler.php";
require "Errors/ExceptionHandler.php";
require "PackageManager.php";
require "Eloquent.php";

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

        Autoloader::load(__DIR__ . '/../config/');

        /**
         * Handle erros internally
         */
        error_reporting(E_ALL);
        set_error_handler('\LexSystems\Framework\Kernel\ErrorHandler::errorHandler');
        set_exception_handler('\LexSystems\Framework\Kernel\ExceptionHandler::exceptionHandler');


        /**
         * Boot eloquent and facades
         */

        Eloquent::boot();

        /**
         * Boot framework packages
         */

        $packages = new PackageManager();
        $packages->boot();
    }
}