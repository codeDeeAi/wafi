<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0a3489614dfb6fab9f03ad2251c47c9
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Minicli\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Minicli\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf0a3489614dfb6fab9f03ad2251c47c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf0a3489614dfb6fab9f03ad2251c47c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf0a3489614dfb6fab9f03ad2251c47c9::$classMap;

        }, null, ClassLoader::class);
    }
}
