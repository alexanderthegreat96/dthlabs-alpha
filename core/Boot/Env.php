<?php
namespace LexSystems\Framework\Core\Boot;
class Env
{
    /**
     * @return \Dotenv\Dotenv
     */
    public static function boot()
    {
        $dotenv = \Dotenv\Dotenv::createMutable(realpath($_SERVER["DOCUMENT_ROOT"]));
        $dotenv->safeLoad();
    }
}