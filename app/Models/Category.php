<?php

namespace App\Models;

class Category extends BaseModel
{
    protected static string $table = 'categories';

    public static function byType(string $type): array
    {
        $stmt = self::pdo()->prepare('SELECT * FROM categories WHERE type = ? ORDER BY name ASC');
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    public static function save(array $data, ?int $id = null): void
    {
        if ($id) {
            $stmt = self::pdo()->prepare('UPDATE categories SET name=?, type=?, color=? WHERE id=?');
            $stmt->execute([$data['name'], $data['type'], $data['color'], $id]);
            return;
        }

        $stmt = self::pdo()->prepare('INSERT INTO categories (name, type, color) VALUES (?, ?, ?)');
        $stmt->execute([$data['name'], $data['type'], $data['color']]);
    }
}
