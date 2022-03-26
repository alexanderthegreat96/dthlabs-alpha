<?php
namespace LexSystems\Framework\Core\Boot;
use LexSystems\Framework\Core\Aliases;
use LexSystems\Framework\Core\Autoloader;
require __DIR__."/../Aliases.php";
class LoadClasses
{
    /**
     * Loads all libraries and classes
     */
    public static function boot():void
    {
        Autoloader::loadComposerLibs(__DIR__ . '/../Libs/');
        Autoloader::loadComposerLibs(__DIR__ . '/../SystemDependencies/');
        Autoloader::load(__DIR__ . '/../System/');
        Autoloader::load(__DIR__ . '/../App/');
        Autoloader::load(__DIR__ . '/../Kernel/');
        Aliases::init();
        Autoloader::load(__DIR__ . '/../../app/Models/');
        Autoloader::load(__DIR__ . '/../../app/Middleware/');
        Autoloader::load(__DIR__ . '/../../app/Controller/');
        Autoloader::load(__DIR__ . '/../../database/');
        return;
    }
}
?>
