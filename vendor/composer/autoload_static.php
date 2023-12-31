<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3f4aeb9248877649e70f8364dc4efc95
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sapphire\\Mcq\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sapphire\\Mcq\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3f4aeb9248877649e70f8364dc4efc95::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3f4aeb9248877649e70f8364dc4efc95::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3f4aeb9248877649e70f8364dc4efc95::$classMap;

        }, null, ClassLoader::class);
    }
}
