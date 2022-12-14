<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce33454bbe6f0cfaf3f6518d5ba365ab
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Ginger\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ginger\\' => 
        array (
            0 => __DIR__ . '/..' . '/gingerpayments/ginger-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce33454bbe6f0cfaf3f6518d5ba365ab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce33454bbe6f0cfaf3f6518d5ba365ab::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce33454bbe6f0cfaf3f6518d5ba365ab::$classMap;

        }, null, ClassLoader::class);
    }
}
