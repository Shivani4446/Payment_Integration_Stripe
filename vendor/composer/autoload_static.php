<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6130c2ca080c46d4879fb84caec56196
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6130c2ca080c46d4879fb84caec56196::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6130c2ca080c46d4879fb84caec56196::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6130c2ca080c46d4879fb84caec56196::$classMap;

        }, null, ClassLoader::class);
    }
}