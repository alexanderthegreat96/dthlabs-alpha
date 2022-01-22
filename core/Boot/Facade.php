<?php
namespace LexSystems\Framework\Core\Boot;
class Facade
{
    /**
     * Bootstrap facade
     */
    public static function boot()
    {
        $app = new \Illuminate\Container\Container();
        \Illuminate\Support\Facades\Facade::setFacadeApplication($app);

        $app->singleton('hash', function () use ($app) {
            return new \Illuminate\Hashing\HashManager\HashManager($app);
        });
        class_alias(\Illuminate\Support\Facades\DB::class, 'DB');
        class_alias(\Illuminate\Support\Facades\Hash::class, 'Hash');
    }
}