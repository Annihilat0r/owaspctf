<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87acdbec83dd937d1ca1cfa3df3d5c8f
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\HTMLToMarkdown\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\HTMLToMarkdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/html-to-markdown/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'f' => 
        array (
            'fin1te\\SafeCurl' => 
            array (
                0 => __DIR__ . '/..' . '/fin1te/safecurl/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit87acdbec83dd937d1ca1cfa3df3d5c8f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit87acdbec83dd937d1ca1cfa3df3d5c8f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit87acdbec83dd937d1ca1cfa3df3d5c8f::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
