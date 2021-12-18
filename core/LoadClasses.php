<?php
namespace LexSystems\Framework\Boot;
class LoadClasses
{
    public static function boot():void
    {
        Autoloader::loadComposerLibs(__DIR__.'/Libs/');
        Autoloader::loadComposerLibs(__DIR__.'/SystemDependencies/');
        Autoloader::load(__DIR__.'/../core/System/');
        Autoloader::load(__DIR__.'/../core/Kernel/');
        Autoloader::load(__DIR__.'/../app/Routes/');
        Autoloader::load(__DIR__.'/../app/Model/');
        Autoloader::load(__DIR__.'/../app/Controller/');
        return;
    }
}
?>
