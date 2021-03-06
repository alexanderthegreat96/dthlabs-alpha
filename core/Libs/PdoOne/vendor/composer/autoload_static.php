<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86be180b4c95c52de57efed08245ac73
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/pdoone/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit86be180b4c95c52de57efed08245ac73::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit86be180b4c95c52de57efed08245ac73::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit86be180b4c95c52de57efed08245ac73::$classMap;

        }, null, ClassLoader::class);
    }
}
