<?php
namespace LexSystems\Framework\Core\Boot;
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
            'host'      => \LexSystems\Framework\Config\Database\MysqlConfig::getHost(),
            'database'  => \LexSystems\Framework\Config\Database\MysqlConfig::getDb(),
            'username'  => \LexSystems\Framework\Config\Database\MysqlConfig::getUser(),
            'password'  => \LexSystems\Framework\Config\Database\MysqlConfig::getPass(),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
             ]
        );

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}