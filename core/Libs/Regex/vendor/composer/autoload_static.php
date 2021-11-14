<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4092a2971d91074146df83a52dc9bbfc
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Spatie\\Regex\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Spatie\\Regex\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/regex/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4092a2971d91074146df83a52dc9bbfc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4092a2971d91074146df83a52dc9bbfc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4092a2971d91074146df83a52dc9bbfc::$classMap;

        }, null, ClassLoader::class);
    }
}
