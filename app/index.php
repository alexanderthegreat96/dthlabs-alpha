<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . "/../core/Class.loader.php";
/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('\LexSystems\Framework\Kernel\Error::errorHandler');
set_exception_handler('\LexSystems\Framework\Kernel\Error::exceptionHandler');
/**
 * Routing
 */
require 'dispatch.php';
?>
