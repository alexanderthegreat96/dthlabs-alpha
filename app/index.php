<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . "/../core/Boot.php";
/**
 * Routing
 */
require 'routes.php';
?>
