<?php
namespace LexSystems\Framework\Core;
use LexSystems\Framework\Core\Boot\BootSystem;
require __DIR__.'/Boot/BootSystem.php';
class App
{
    /**
     * @return BootSystem
     */
    public static function boot()
    {
        return new BootSystem();
    }
}