<?php

namespace App\Support;

class Cookie
{
    /**
     * @param string $name
     * @return bool
     */
    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * @param string $name
     * @param $value
     * @param int $time
     */
    public static function set(string $name, $value, $time = 2419200): void
    {
        setcookie($name, $value, time() + $time, '/');
    }

    /**
     * @param string $name
     * @return string|null
     */
    public static function get(string $name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function unset(string $name): bool
    {
        if (!$_COOKIE[$name]) {
            return false;
        }

        self::set($name, '', time() - 100);
        unset($_COOKIE[$name]);
        return true;
    }
}