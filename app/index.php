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
try{
    \LexSystems\Framework\Core\Kernel\Route::dispatch();
}
catch (\Exception $e)
{
    View::renderTemplate('kernel',
        [
            'error' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
}

?>
