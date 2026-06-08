<?php

namespace App\Models;

class News extends BaseModel
{
    protected static string $table = 'news';

    public static function active(array $filters = []): array
    {
        return self::search($filters + ['status' => 1]);
    }

    public static function withCategories(array $filters = []): array
    {
        return self::search($filters);
    }

    public static function search(array $filters = []): array
    {
        $where = [];
        $params = [];

        if (($filters['status'] ?? '') !== '') {
            $where[] = 'n.status = ?';
            $params[] = (int) $filters['status'];
        }

        if (!empty($filters['category_id'])) {
            $where[] = 'n.category_id = ?';
            $params[] = (int) $filters['category_id'];
        }

        if (!empty($filters['q'])) {
            $where[] = '(n.title LIKE ? OR n.short_text LIKE ? OR n.body LIKE ?)';
            $term = '%' . $filters['q'] . '%';
            array_push($params, $term, $term, $term);
        }

        $sql = 'SELECT n.*, c.name AS category_name, c.color AS category_color
            FROM news n
            LEFT JOIN categories c ON c.id = n.category_id';

        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY n.featured DESC, n.published_at DESC, n.id DESC';
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function findPublic(int $id): ?array
    {
        $stmt = self::pdo()->prepare('SELECT n.*, c.name AS category_name, c.color AS category_color
            FROM news n
            LEFT JOIN categories c ON c.id = n.category_id
            WHERE n.id = ? AND n.status = 1');
        $stmt->execute([$id]);
        $item = $stmt->fetch() ?: null;
        if ($item) {
            self::pdo()->prepare('UPDATE news SET views = views + 1 WHERE id = ?')->execute([$id]);
        }

        return $item;
    }

    public static function save(array $data, ?int $id = null): void
    {
        if ($id) {
            $stmt = self::pdo()->prepare('UPDATE news SET category_id=?, title=?, short_text=?, body=?, image=?, status=?, featured=?, published_at=? WHERE id=?');
            $stmt->execute([$data['category_id'], $data['title'], $data['short_text'], $data['body'], $data['image'], $data['status'], $data['featured'], $data['published_at'], $id]);
            return;
        }

        $stmt = self::pdo()->prepare('INSERT INTO news (category_id, title, short_text, body, image, status, featured, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['category_id'], $data['title'], $data['short_text'], $data['body'], $data['image'], $data['status'], $data['featured'], $data['published_at']]);
    }
}
