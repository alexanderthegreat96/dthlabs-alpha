<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . "/../core/Boot.php";
/**
 * DO NOT Modify this file
 * Anything bellow this line is crucial for the app
 */
\LexSystems\Framework\Boot\Boot::boot();
require 'routes.php';
?>
