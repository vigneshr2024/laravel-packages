<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda9df8ce845c0f0c73947ba8d4572bb2
{
    public static $prefixLengthsPsr4 = array(
        'W' =>
        array(
            'Sensiple\\Permissions\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array(
        'Sensiple\\Permissions\\' =>
        array(
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array(
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda9df8ce845c0f0c73947ba8d4572bb2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda9df8ce845c0f0c73947ba8d4572bb2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda9df8ce845c0f0c73947ba8d4572bb2::$classMap;
        }, null, ClassLoader::class);
    }
}
