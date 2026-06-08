<?php

namespace App\Core;

use PDO;

final class Database
{
    private static PDO $pdo;

    public static function connect(array $config): void
    {
        self::$pdo = new PDO($config['dsn'], $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public static function pdo(): PDO
    {
        return self::$pdo;
    }

    public static function migrateAndSeed(): void
    {
        $pdo = self::pdo();

        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT "admin",
            created_at TEXT NOT NULL
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            type TEXT NOT NULL DEFAULT "news",
            color TEXT DEFAULT "#75f7ff"
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS teachers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT NOT NULL,
            specialty TEXT NOT NULL,
            experience INTEGER NOT NULL DEFAULT 1,
            phone TEXT,
            bio TEXT,
            photo TEXT,
            status INTEGER NOT NULL DEFAULT 1
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS courses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            category_id INTEGER,
            teacher_id INTEGER,
            title TEXT NOT NULL,
            slug TEXT NOT NULL UNIQUE,
            description TEXT NOT NULL,
            duration TEXT NOT NULL,
            price TEXT NOT NULL,
            image TEXT,
            status INTEGER NOT NULL DEFAULT 1,
            views INTEGER NOT NULL DEFAULT 0,
            featured INTEGER NOT NULL DEFAULT 0,
            FOREIGN KEY (category_id) REFERENCES categories(id),
            FOREIGN KEY (teacher_id) REFERENCES teachers(id)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS news (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            category_id INTEGER,
            title TEXT NOT NULL,
            short_text TEXT NOT NULL,
            body TEXT NOT NULL,
            image TEXT,
            status INTEGER NOT NULL DEFAULT 1,
            published_at TEXT NOT NULL,
            views INTEGER NOT NULL DEFAULT 0,
            featured INTEGER NOT NULL DEFAULT 0,
            FOREIGN KEY (category_id) REFERENCES categories(id)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS applications (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            course_id INTEGER,
            first_name TEXT NOT NULL,
            last_name TEXT NOT NULL,
            phone TEXT NOT NULL,
            message TEXT,
            status TEXT NOT NULL DEFAULT "Yangi",
            created_at TEXT NOT NULL,
            FOREIGN KEY (course_id) REFERENCES courses(id)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS settings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            setting_key TEXT NOT NULL UNIQUE,
            setting_value TEXT
        )');

        self::ensureColumn('categories', 'color', 'TEXT DEFAULT "#75f7ff"');
        self::ensureColumn('courses', 'category_id', 'INTEGER');
        self::ensureColumn('courses', 'views', 'INTEGER NOT NULL DEFAULT 0');
        self::ensureColumn('courses', 'featured', 'INTEGER NOT NULL DEFAULT 0');
        self::ensureColumn('news', 'views', 'INTEGER NOT NULL DEFAULT 0');
        self::ensureColumn('news', 'featured', 'INTEGER NOT NULL DEFAULT 0');
        $pdo->exec('UPDATE courses SET category_id = 1 WHERE category_id IS NULL');
        $pdo->exec('UPDATE news SET category_id = 3 WHERE category_id IS NULL');

        if ((int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn() === 0) {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, created_at) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute(['Administrator', 'admin@smartedu.uz', password_hash('admin123', PASSWORD_DEFAULT), 'admin', date('Y-m-d H:i:s')]);
        }

        if ((int) $pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn() === 0) {
            $categories = [
                ['Dasturlash', 'course', '#75f7ff'],
                ['Dizayn', 'course', '#ff4fd8'],
                ['Yangiliklar', 'news', '#f8ff4f'],
                ['E‘lonlar', 'news', '#00d6c9'],
            ];
            $stmt = $pdo->prepare('INSERT INTO categories (name, type, color) VALUES (?, ?, ?)');
            foreach ($categories as $row) {
                $stmt->execute($row);
            }
        }

        if ((int) $pdo->query('SELECT COUNT(*) FROM teachers')->fetchColumn() === 0) {
            $teachers = [
                ['Aziza Karimova', 'Frontend dasturchi', 5, '+998 90 111 22 33', 'React, UI va web dizayn bo‘yicha amaliy darslar olib boradi.'],
                ['Javlon Ergashev', 'Backend dasturchi', 7, '+998 93 444 55 66', 'PHP, Yii2, MySQL va REST API bo‘yicha tajribali mentor.'],
                ['Madina Sobirova', 'Grafik dizayner', 4, '+998 94 777 88 99', 'Branding, Figma va vizual kompozitsiya yo‘nalishida ishlaydi.'],
            ];
            $stmt = $pdo->prepare('INSERT INTO teachers (full_name, specialty, experience, phone, bio, status) VALUES (?, ?, ?, ?, ?, 1)');
            foreach ($teachers as $teacher) {
                $stmt->execute($teacher);
            }
        }

        if ((int) $pdo->query('SELECT COUNT(*) FROM courses')->fetchColumn() === 0) {
            $courses = [
                [1, 2, 'PHP Yii2 va CMS', 'php-yii2-cms', 'Yii2 frameworki, MVC, CRUD, admin panel va ma‘lumotlar bazasi bilan to‘liq amaliy kurs.', '4 oy', '650 000 so‘m'],
                [1, 1, 'Frontend Foundation', 'frontend-foundation', 'HTML, CSS, JavaScript va responsiv sayt yaratish bo‘yicha boshlang‘ichdan amaliy yo‘nalish.', '3 oy', '550 000 so‘m'],
                [2, 3, 'UI/UX Design', 'ui-ux-design', 'Figma, prototiplash, rang, tipografika va foydalanuvchi tajribasini loyihalash.', '2 oy', '500 000 so‘m'],
            ];
            $stmt = $pdo->prepare('INSERT INTO courses (category_id, teacher_id, title, slug, description, duration, price, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, 1, 1)');
            foreach ($courses as $course) {
                $stmt->execute($course);
            }
        }

        if ((int) $pdo->query('SELECT COUNT(*) FROM news')->fetchColumn() === 0) {
            $news = [
                [3, 'Yangi guruhlar ochildi', 'PHP Yii2, Frontend va UI/UX kurslari uchun yangi guruhlarga qabul boshlandi.', 'Yangi mavsum uchun zamonaviy dasturlash va dizayn yo‘nalishlarida guruhlar ochildi. Joylar soni cheklangan.', date('Y-m-d')],
                [4, 'Bepul sinov darsi', 'Har shanba kuni bepul sinov darslari tashkil etiladi.', 'Sinov darsida mentorlar bilan tanishasiz, kurs dasturi va o‘quv jarayoni haqida batafsil ma‘lumot olasiz.', date('Y-m-d')],
            ];
            $stmt = $pdo->prepare('INSERT INTO news (category_id, title, short_text, body, status, published_at, featured) VALUES (?, ?, ?, ?, 1, ?, 1)');
            foreach ($news as $item) {
                $stmt->execute($item);
            }
        }

        if ((int) $pdo->query('SELECT COUNT(*) FROM settings')->fetchColumn() === 0) {
            $settings = [
                'site_name' => 'SmartEdu CMS',
                'hero_title' => 'O‘quv markazi uchun takrorlanmas CMS ekotizimi',
                'hero_subtitle' => 'Glassmorphism, dark neon tech, 3D kartalar, AI workspace, magazine layout va gamified dashboard bitta katta SmartEdu platformasiga birlashtirildi.',
                'phone' => '+998 90 123 45 67',
                'address' => 'Toshkent shahri, IT Park hududi',
                'telegram' => '@smartedu',
                'instagram' => '@smartedu.cms',
                'email' => 'info@smartedu.uz',
            ];
            $stmt = $pdo->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)');
            foreach ($settings as $key => $value) {
                $stmt->execute([$key, $value]);
            }
        }
    }

    private static function ensureColumn(string $table, string $column, string $definition): void
    {
        $columns = self::pdo()->query('PRAGMA table_info(' . $table . ')')->fetchAll();
        foreach ($columns as $row) {
            if (($row['name'] ?? null) === $column) {
                return;
            }
        }

        self::pdo()->exec('ALTER TABLE ' . $table . ' ADD COLUMN ' . $column . ' ' . $definition);
    }
}
