<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3f2eca801fc02eabd4ae87f0855a9c2
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LanguageDetection\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LanguageDetection\\' => 
        array (
            0 => __DIR__ . '/..' . '/patrickschur/language-detection/src/LanguageDetection',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc3f2eca801fc02eabd4ae87f0855a9c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc3f2eca801fc02eabd4ae87f0855a9c2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc3f2eca801fc02eabd4ae87f0855a9c2::$classMap;

        }, null, ClassLoader::class);
    }
}
