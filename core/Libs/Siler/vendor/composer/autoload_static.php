<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit19e7b55b557240ebb8315646618ac738
{
    public static $files = array (
        '625767ee32589091312b4f81c394cb8e' => __DIR__ . '/..' . '/leocavalcante/siler/src/Container/Container.php',
        '656295b2b746a458b49fdac85cbeb070' => __DIR__ . '/..' . '/leocavalcante/siler/src/Db/Db.php',
        '8ba2280edc72648410de21d32f0efb5a' => __DIR__ . '/..' . '/leocavalcante/siler/src/Db/Mongo.php',
        '3237254a01d0bd5d68d488719057bd2b' => __DIR__ . '/..' . '/leocavalcante/siler/src/Db/Redis.php',
        'a6763048ebd6f6db73908c9aeaf523c6' => __DIR__ . '/..' . '/leocavalcante/siler/src/Diactoros/Diactoros.php',
        '7304b8c5be2b81b6cc64c45da152dec2' => __DIR__ . '/..' . '/leocavalcante/siler/src/Dotenv/Dotenv.php',
        'c7aeb74efa59ec95abef54a0800d45ae' => __DIR__ . '/..' . '/leocavalcante/siler/src/Functional/Functional.php',
        'fa5241aeb4ddbe24a4e23463194158e5' => __DIR__ . '/..' . '/leocavalcante/siler/src/Functional/Monad/Monad.php',
        'f333f7f529424dc2d9d6bca5aee64500' => __DIR__ . '/..' . '/leocavalcante/siler/src/GraphQL/GraphQL.php',
        'a9e8d1aa40eb759bf70c823f0dbeab03' => __DIR__ . '/..' . '/leocavalcante/siler/src/Http/Http.php',
        '9e4a9bcf2d310f409cea2bc9a3a8455b' => __DIR__ . '/..' . '/leocavalcante/siler/src/Http/Request.php',
        'c9f0fdbb3695ff6ec5eb95869c2c8da3' => __DIR__ . '/..' . '/leocavalcante/siler/src/Http/Response.php',
        '6102a9e75bf88fd866278258b142fab0' => __DIR__ . '/..' . '/leocavalcante/siler/src/HttpHandlerRunner/HttpHandlerRunner.php',
        '69c19ab11acf0681f8a404983a605346' => __DIR__ . '/..' . '/leocavalcante/siler/src/Mail/SwiftMailer.php',
        'f7e88c7f1e5ea7948ad27e24e0f1cd92' => __DIR__ . '/..' . '/leocavalcante/siler/src/Monolog/Monolog.php',
        '3cf426ec0c1a83084775d36f89d731ef' => __DIR__ . '/..' . '/leocavalcante/siler/src/Prelude/Str.php',
        'ac6c9ed44a5b02547507fd3dbbeaa7f7' => __DIR__ . '/..' . '/leocavalcante/siler/src/Prelude/Tuple.php',
        '34559f6c075fc9d18eec282808fd42db' => __DIR__ . '/..' . '/leocavalcante/siler/src/Result/Result.php',
        'ae063a9e7311ba8f8f22a18f3fc99b14' => __DIR__ . '/..' . '/leocavalcante/siler/src/Route/Route.php',
        'fcbab2f213786e947303ed322c6bc799' => __DIR__ . '/..' . '/leocavalcante/siler/src/Stratigility/Stratigility.php',
        '2c2d7d981258f2a571c5ccc429e24eff' => __DIR__ . '/..' . '/leocavalcante/siler/src/Swoole/Swoole.php',
        '8b2eeb0829fb552bb33e813f8894be3b' => __DIR__ . '/..' . '/leocavalcante/siler/src/Twig/Twig.php',
        '671f27b10beca1fbee888aebc293e01d' => __DIR__ . '/..' . '/leocavalcante/siler/src/Siler.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Siler\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Siler\\' => 
        array (
            0 => __DIR__ . '/..' . '/leocavalcante/siler/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit19e7b55b557240ebb8315646618ac738::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit19e7b55b557240ebb8315646618ac738::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit19e7b55b557240ebb8315646618ac738::$classMap;

        }, null, ClassLoader::class);
    }
}
