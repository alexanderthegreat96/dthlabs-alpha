<?php
namespace LexSystems\Framework\Boot;
use Illuminate\Database\Capsule\Manager as Capsule;
class Eloquent
{
    public static function boot()
    {
        $capsule = new Capsule;
        $capsule->addConnection
        (
            [
            'driver'    => 'mysql',
            'host'      => \LexSystems\Framework\Configs\Database\MysqlConfig::getHost(),
            'database'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getDb(),
            'username'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getUser(),
            'password'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getPass(),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
             ]
        );

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}