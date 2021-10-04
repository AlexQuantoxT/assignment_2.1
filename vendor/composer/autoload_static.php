<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9e323fac850df54ac82c9052bc5176d9
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyApp\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyApp\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9e323fac850df54ac82c9052bc5176d9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9e323fac850df54ac82c9052bc5176d9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9e323fac850df54ac82c9052bc5176d9::$classMap;

        }, null, ClassLoader::class);
    }
}
