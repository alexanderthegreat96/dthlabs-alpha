<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde136a08ca660d35942825b56e32da9b
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\MimeTypeDetection\\' => 25,
            'League\\Flysystem\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\MimeTypeDetection\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/mime-type-detection/src',
        ),
        'League\\Flysystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/flysystem/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitde136a08ca660d35942825b56e32da9b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde136a08ca660d35942825b56e32da9b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitde136a08ca660d35942825b56e32da9b::$classMap;

        }, null, ClassLoader::class);
    }
}
