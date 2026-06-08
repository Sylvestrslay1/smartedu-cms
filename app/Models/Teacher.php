<?php

namespace App\Models;

class Teacher extends BaseModel
{
    protected static string $table = 'teachers';

    public static function save(array $data, ?int $id = null): void
    {
        if ($id) {
            $stmt = self::pdo()->prepare('UPDATE teachers SET full_name=?, specialty=?, experience=?, phone=?, bio=?, status=? WHERE id=?');
            $stmt->execute([$data['full_name'], $data['specialty'], $data['experience'], $data['phone'], $data['bio'], $data['status'], $id]);
            return;
        }

        $stmt = self::pdo()->prepare('INSERT INTO teachers (full_name, specialty, experience, phone, bio, status) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['full_name'], $data['specialty'], $data['experience'], $data['phone'], $data['bio'], $data['status']]);
    }
}
