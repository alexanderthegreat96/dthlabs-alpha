<?php
namespace LexSystems\Framework\Core\Boot;
use Illuminate\Database\Capsule\Manager as Capsule;
use LexSystems\Framework\Config\Database\MysqlConfig as Config;
class Eloquent
{
    public static function boot()
    {
        $capsule = new Capsule;
        $capsule->addConnection
        (
            [
            'driver'    => 'mysql',
            'host'      => Config::MYSQL_HOST,
            'database'  => Config::MYSQL_DB,
            'username'  => Config::MYSQL_USER,
            'password'  => Config::MYSQL_PASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
             ]
        );

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}