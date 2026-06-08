<?php

namespace App\Models;

class Setting extends BaseModel
{
    protected static string $table = 'settings';

    public static function allKeyed(): array
    {
        $rows = self::pdo()->query('SELECT setting_key, setting_value FROM settings ORDER BY setting_key ASC')->fetchAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    public static function get(string $key, string $default = ''): string
    {
        $stmt = self::pdo()->prepare('SELECT setting_value FROM settings WHERE setting_key = ?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $default : (string) $value;
    }

    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            $exists = self::get((string) $key, "\0") !== "\0";
            if ($exists) {
                $stmt = self::pdo()->prepare('UPDATE settings SET setting_value = ? WHERE setting_key = ?');
                $stmt->execute([trim((string) $value), $key]);
                continue;
            }

            $stmt = self::pdo()->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)');
            $stmt->execute([$key, trim((string) $value)]);
        }
    }
}
