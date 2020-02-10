<?php

namespace App\Support;

class Paths
{
    public static function getRootPath()
    {
        return __DIR__ . '/../..';
    }

    public static function getPathToConfigFile(string $name)
    {
        return self::getRootPath() . '/config/' . $name . '.php';
    }

    public static function getTemplatePath()
    {
        return self::getRootPath() . '/templates/';
    }
}