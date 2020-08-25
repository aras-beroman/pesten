<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit087402aabda43ab51f1692f579c0bf5b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit087402aabda43ab51f1692f579c0bf5b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit087402aabda43ab51f1692f579c0bf5b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
