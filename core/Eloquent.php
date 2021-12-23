<?php
namespace LexSystems\Framework\Boot;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Hashing\HashManager;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;

class Eloquent
{
    public static function boot()
    {
        $app = new Container();
        Facade::setFacadeApplication($app);
        $capsule = new Capsule;

        $capsule->addConnection(array(
            'driver'    => 'mysql',
            'host'      => \LexSystems\Framework\Configs\Database\MysqlConfig::getHost(),
            'database'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getDb(),
            'username'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getUser(),
            'password'  => \LexSystems\Framework\Configs\Database\MysqlConfig::getPass(),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ));

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $app->singleton('hash', function () use ($app) {
            return new HashManager($app);
        });

        class_alias(\Illuminate\Support\Facades\DB::class, 'DB');
        class_alias(\Illuminate\Support\Facades\Hash::class, 'Hash');

    }
}