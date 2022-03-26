<?php
namespace LexSystems\Framework\Core\Boot;
use LexSystems\Framework\Core\Autoloader;
require __DIR__.'/../Autoloader.php';
require __DIR__."/LoadClasses.php";
require  __DIR__."/../Errors/ErrorHandler.php";
require __DIR__."/../Errors/ShutdownHandler.php";
require __DIR__."/../Errors/ExceptionHandler.php";
require __DIR__."/PackageManager.php";
require __DIR__."/Facade.php";
require  __DIR__."/Eloquent.php";
require  __DIR__."/Env.php";

class BootSystemCli
{
    /**
     * Boot constructor
     */
    public function __construct()
    {

        /**
         * Load the rest of the classes
         */

        LoadClasses::boot();

        /**
         * Load configuration files
         */

        Autoloader::load(__DIR__ . '/../../config/');

        /**
         * Boot facade
         */

        Facade::boot();

        /**
         * Boot eloquent and facades
         */

        Eloquent::boot();

        /**
         * Env support
         * $_ENV
         */

        Env::boot();

        /**
         * Boot framework packages
         */

        $packages = new PackageManager();
        $packages->boot();
    }
}