<?php
require "Autoload.php";
require "PackageManager.php";
\LexSystems\Framework\Autoloader::loadComposerLibs(__DIR__.'/Libs/');
\LexSystems\Framework\Autoloader::loadComposerLibs(__DIR__.'/SystemDependencies/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../config/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../core/System/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../core/Kernel/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Routes/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Controller/');
\LexSystems\Framework\Autoloader::load(__DIR__.'/../app/Model/');


$packages  = new LexSystems\Framework\Kernel\PackageManager\PackageManager();
$packages->boot();

?>
