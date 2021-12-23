<?php
namespace LexSystems\Framework\Boot;
require "BootSystem.php";
class Bootstrap extends BootSystem
{
    /**
     * @return BootSystem
     */
    public static function boot()
    {
        return new BootSystem();
    }
}