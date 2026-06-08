<?php

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class BaseModel
{
    protected static string $table;

    public static function all(string $order = 'id DESC'): array
    {
        return Database::pdo()->query('SELECT * FROM ' . static::$table . ' ORDER BY ' . $order)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function delete(int $id): void
    {
        $stmt = Database::pdo()->prepare('DELETE FROM ' . static::$table . ' WHERE id = ?');
        $stmt->execute([$id]);
    }

    protected static function pdo(): PDO
    {
        return Database::pdo();
    }
}
