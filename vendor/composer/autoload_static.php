<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4ec49050a20a56a8947fc9d0fa68c63
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sts\\' => 4,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sts\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4ec49050a20a56a8947fc9d0fa68c63::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4ec49050a20a56a8947fc9d0fa68c63::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
