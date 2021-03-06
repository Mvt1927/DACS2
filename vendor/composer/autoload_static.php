<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b25900a2ff2e0e9bf9a479d6a0fbbe7
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b25900a2ff2e0e9bf9a479d6a0fbbe7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b25900a2ff2e0e9bf9a479d6a0fbbe7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2b25900a2ff2e0e9bf9a479d6a0fbbe7::$classMap;

        }, null, ClassLoader::class);
    }
}
