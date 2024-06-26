<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit45842763ba8222de875408a641334380
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hashemi\\CsvExport\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hashemi\\CsvExport\\' => 
        array (
            0 => __DIR__ . '/..' . '/hashemi/php-csv-export/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit45842763ba8222de875408a641334380::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit45842763ba8222de875408a641334380::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit45842763ba8222de875408a641334380::$classMap;

        }, null, ClassLoader::class);
    }
}
