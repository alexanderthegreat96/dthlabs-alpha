<?php

/**
 * Require shutdown for error mapping
 */
require "Shutdown.php";
register_shutdown_function('shutdownHandler');

/**
 * Require classes and packages
 */
require "LoadClasses.php";
require "PackageManager.php";

/**
 * Error and Exception handling
 */

error_reporting(E_ALL);
set_error_handler('\LexSystems\Framework\Kernel\Error::errorHandler');
set_exception_handler('\LexSystems\Framework\Kernel\Error::exceptionHandler');

/**
 * Boot packages
 * aka include them
 */
$packages  = new LexSystems\Framework\Kernel\PackageManager\PackageManager();
$packages->boot();

