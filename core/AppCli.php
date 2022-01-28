<?php
namespace LexSystems\Framework\Core;
use LexSystems\Framework\Core\Boot\BootSystemCli;
require __DIR__.'/Boot/BootSystemCli.php';
class AppCli
{
    /**
     * @return BootSystemCli
     */
    public static function boot()
    {
        return new BootSystemCli();
    }
}