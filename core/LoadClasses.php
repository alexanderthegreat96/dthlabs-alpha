<?php
namespace LexSystems\Framework\Boot;
class LoadClasses
{
    public static function boot():void
    {
        Autoloader::loadComposerLibs(__DIR__.'/Libs/');
        Autoloader::loadComposerLibs(__DIR__.'/SystemDependencies/');
        Autoloader::load(__DIR__.'/System/');
        Autoloader::load(__DIR__.'/Kernel/');
        Autoloader::load(__DIR__.'/bin/');
        Autoloader::load(__DIR__.'/../app/Model/');
        Autoloader::load(__DIR__.'/../app/Middleware/');
        Autoloader::load(__DIR__.'/../app/Controller/');
        return;
    }
}
?>
