<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7dbb23fe208951eebaf10b8876e9936a
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Nelwhix\\ImageResizer\\' => 21,
        ),
        'I' => 
        array (
            'Imagine\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Nelwhix\\ImageResizer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Imagine\\' => 
        array (
            0 => __DIR__ . '/..' . '/imagine/imagine/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7dbb23fe208951eebaf10b8876e9936a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7dbb23fe208951eebaf10b8876e9936a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7dbb23fe208951eebaf10b8876e9936a::$classMap;

        }, null, ClassLoader::class);
    }
}