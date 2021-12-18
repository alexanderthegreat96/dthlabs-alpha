<?php
/**
 * Require autoloader
 */

use Illuminate\Database\Capsule\Manager as Capsule;

require 'Autoloader.php';

/**
 * Require error handler
 */

require "Errors/ErrorHandler.php";

/**
 * Require shutdown handler
 */

require "Errors/ShutdownHandler.php";
register_shutdown_function('shutdownHandler');

/**
 * Require class loader
 */

require "LoadClasses.php";

/**
 * Use autoloader to load configuration for excetion handler
 */

\LexSystems\Framework\Autoloader::load(__DIR__ . '/../config/');

/**
 * Require exception handler
 */
require "Errors/ExceptionHandler.php";

/**
 * Require package manager
 */
require "PackageManager.php";

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

$packages = new LexSystems\Framework\Kernel\PackageManager\PackageManager();
$packages->boot();

