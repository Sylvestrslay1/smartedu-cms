<?php

namespace App\Core;

final class App
{
    private static array $config = [];

    public static function boot(array $config): void
    {
        self::$config = $config;
        Database::connect($config['db']);
        Database::migrateAndSeed();
    }

    public static function config(string $key, mixed $default = null): mixed
    {
        return self::$config[$key] ?? $default;
    }
}
