<?php
require "Autoload.php";
/**
 * Libraries
 */
\LexSystems\Framework\Autoloader::loadComposerLibs(__DIR__.'/Libs/');
/**
 * System Dependencies - > Libraries mostly, but stuff that cannot be autoupdated
 * without the risk of breaking the core.
 */
\LexSystems\Framework\Autoloader::loadComposerLibs(__DIR__.'/SystemDependencies/');
/**
 * System Packages
 */
\LexSystems\Framework\Autoloader::loadComposerLibs(__DIR__.'/Packages/');
/**
 * Configuration files
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../config/');
/**
 * System Midlewares
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../core/System/');
/**
 * Kernel
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../core/Kernel/');
/**
 * Routes
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Routes/');
/**
 * Controllers
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Controller/');
/**
 * Models
 */
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Model/');
?>
