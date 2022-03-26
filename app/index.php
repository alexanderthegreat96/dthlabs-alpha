<?php
/**
 * Init necesarry sessions
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use LexSystems\Framework\Core\Kernel\View;
/**
 * Bootstrap Application Components
 */
require __DIR__ . "/../core/App.php";
\LexSystems\Framework\Core\App::boot();

/**
 * Bootstrap Routes
 */
require 'Routes.php';
\LexSystems\Framework\Core\Kernel\Route::dispatch();
?>
