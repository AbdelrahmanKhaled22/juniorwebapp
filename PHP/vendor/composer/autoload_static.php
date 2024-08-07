<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd751713988987e9331980363e24189ce
{
    public static $files = array (
        'ced3aae73c702142bbef1d66f18336e3' => __DIR__ . '/../..' . '/Config/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'ProductData\\' => 12,
            'ProductAPI\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ProductData\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Data',
        ),
        'ProductAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/API',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd751713988987e9331980363e24189ce::$classMap;

        }, null, ClassLoader::class);
    }
}
