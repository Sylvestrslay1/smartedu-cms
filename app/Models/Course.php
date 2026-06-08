<?php

namespace App\Models;

class Course extends BaseModel
{
    protected static string $table = 'courses';

    public static function active(array $filters = []): array
    {
        return self::search($filters + ['status' => 1]);
    }

    public static function withTeachers(array $filters = []): array
    {
        return self::search($filters);
    }

    public static function featured(int $limit = 6): array
    {
        $stmt = self::pdo()->prepare('SELECT c.*, t.full_name AS teacher_name, cat.name AS category_name, cat.color AS category_color
            FROM courses c
            LEFT JOIN teachers t ON t.id = c.teacher_id
            LEFT JOIN categories cat ON cat.id = c.category_id
            WHERE c.status = 1
            ORDER BY c.featured DESC, c.id DESC
            LIMIT ?');
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function search(array $filters = []): array
    {
        $where = [];
        $params = [];

        if (($filters['status'] ?? '') !== '') {
            $where[] = 'c.status = ?';
            $params[] = (int) $filters['status'];
        }

        if (!empty($filters['category_id'])) {
            $where[] = 'c.category_id = ?';
            $params[] = (int) $filters['category_id'];
        }

        if (!empty($filters['q'])) {
            $where[] = '(c.title LIKE ? OR c.description LIKE ? OR t.full_name LIKE ?)';
            $term = '%' . $filters['q'] . '%';
            array_push($params, $term, $term, $term);
        }

        $sql = 'SELECT c.*, t.full_name AS teacher_name, cat.name AS category_name, cat.color AS category_color
            FROM courses c
            LEFT JOIN teachers t ON t.id = c.teacher_id
            LEFT JOIN categories cat ON cat.id = c.category_id';

        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY c.featured DESC, c.id DESC';
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = self::pdo()->prepare('SELECT c.*, t.full_name AS teacher_name, t.bio AS teacher_bio, cat.name AS category_name, cat.color AS category_color
            FROM courses c
            LEFT JOIN teachers t ON t.id = c.teacher_id
            LEFT JOIN categories cat ON cat.id = c.category_id
            WHERE c.slug = ?');
        $stmt->execute([$slug]);
        $course = $stmt->fetch() ?: null;
        if ($course) {
            self::pdo()->prepare('UPDATE courses SET views = views + 1 WHERE id = ?')->execute([$course['id']]);
        }

        return $course;
    }

    public static function save(array $data, ?int $id = null): void
    {
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $data['slug'] ?: $data['title']), '-'));

        if ($id) {
            $stmt = self::pdo()->prepare('UPDATE courses SET category_id=?, teacher_id=?, title=?, slug=?, description=?, duration=?, price=?, image=?, status=?, featured=? WHERE id=?');
            $stmt->execute([$data['category_id'], $data['teacher_id'], $data['title'], $slug, $data['description'], $data['duration'], $data['price'], $data['image'], $data['status'], $data['featured'], $id]);
            return;
        }

        $stmt = self::pdo()->prepare('INSERT INTO courses (category_id, teacher_id, title, slug, description, duration, price, image, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['category_id'], $data['teacher_id'], $data['title'], $slug, $data['description'], $data['duration'], $data['price'], $data['image'], $data['status'], $data['featured']]);
    }
}
