<?php
namespace LexSystems\Framework\Boot;
use Illuminate\Database\Capsule\Manager as Capsule;
use LexSystems\Framework\Kernel\PackageManager;
require 'Autoloader.php';
require "LoadClasses.php";
require "Errors/ErrorHandler.php";
require "Errors/ShutdownHandler.php";
require "Errors/ExceptionHandler.php";
require "PackageManager.php";
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
         * Boot eloquent ORM
         */

        $capsule = new Capsule;

        $capsule->addConnection(array(
            'driver'    => 'mysql',
            'host'      => \LexSystems\Framework\Configs\Database\MysqlConfig::getHost(),
            'database'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getDb(),
            'username'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getUser(),
            'password'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getPass(),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ));

        $capsule->bootEloquent();
        $capsule->setAsGlobal();

        /**
         * Boot framework packages
         */

        $packages = new PackageManager();
        $packages->boot();
    }
}