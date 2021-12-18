<?php
namespace LexSystems\Framework\Boot;
require "BootSystem.php";
class Boot extends BootSystem
{
    /**
     * @return BootSystem
     */
    public static function boot()
    {
        return new BootSystem();
    }
}