<?php

namespace App\Models;

class User extends BaseModel
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?array
    {
        $stmt = self::pdo()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public static function save(array $data, ?int $id = null): void
    {
        if ($id) {
            $fields = ['name=?', 'email=?', 'role=?'];
            $params = [$data['name'], $data['email'], $data['role']];
            if (!empty($data['password'])) {
                $fields[] = 'password_hash=?';
                $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            $params[] = $id;
            $stmt = self::pdo()->prepare('UPDATE users SET ' . implode(', ', $fields) . ' WHERE id=?');
            $stmt->execute($params);
            return;
        }

        $stmt = self::pdo()->prepare('INSERT INTO users (name, email, password_hash, role, created_at) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$data['name'], $data['email'], password_hash($data['password'] ?: 'admin123', PASSWORD_DEFAULT), $data['role'], date('Y-m-d H:i:s')]);
    }

    public static function changePassword(int $id, string $password): void
    {
        $stmt = self::pdo()->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
        $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $id]);
    }
}
