<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit917b8b2e3addf4009125e39ad51ca050
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Eaquinta\\FormComponentsPackage\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Eaquinta\\FormComponentsPackage\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit917b8b2e3addf4009125e39ad51ca050::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit917b8b2e3addf4009125e39ad51ca050::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit917b8b2e3addf4009125e39ad51ca050::$classMap;

        }, null, ClassLoader::class);
    }
}
