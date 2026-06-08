<?php

namespace App\Models;

class Application extends BaseModel
{
    protected static string $table = 'applications';

    public static function withCourses(array $filters = []): array
    {
        $where = [];
        $params = [];

        if (!empty($filters['status'])) {
            $where[] = 'a.status = ?';
            $params[] = $filters['status'];
        }

        if (!empty($filters['course_id'])) {
            $where[] = 'a.course_id = ?';
            $params[] = (int) $filters['course_id'];
        }

        if (!empty($filters['q'])) {
            $where[] = '(a.first_name LIKE ? OR a.last_name LIKE ? OR a.phone LIKE ? OR a.message LIKE ?)';
            $term = '%' . $filters['q'] . '%';
            array_push($params, $term, $term, $term, $term);
        }

        $sql = 'SELECT a.*, c.title AS course_title FROM applications a LEFT JOIN courses c ON c.id = a.course_id';
        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY a.id DESC';

        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function create(array $data): void
    {
        $stmt = self::pdo()->prepare('INSERT INTO applications (course_id, first_name, last_name, phone, message, created_at) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['course_id'], $data['first_name'], $data['last_name'], $data['phone'], $data['message'], date('Y-m-d H:i:s')]);
    }

    public static function updateStatus(int $id, string $status): void
    {
        $stmt = self::pdo()->prepare('UPDATE applications SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }
}
