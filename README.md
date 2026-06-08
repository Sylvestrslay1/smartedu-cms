# SmartEdu CMS

PHP, Yii2 uslubidagi MVC va CMS konsepsiyasi asosida yaratilgan o‘quv markazi sayti.

## Tarkibi

- Ochiq sayt: bosh sahifa, kurslar, kurs batafsili, o‘qituvchilar, yangiliklar, ariza formasi.
- Admin panel: dashboard, kurslar CRUD, o‘qituvchilar CRUD, yangiliklar CRUD, arizalar statusi.
- Ma’lumotlar bazasi: demo uchun SQLite avtomatik yaratiladi.
- MySQL uchun sxema: `data/mysql_schema.sql`.

## Ishga tushirish

PHP o‘rnatilgan bo‘lsa, loyiha papkasida quyidagini bajaring:

```bash
php -S localhost:8000 -t public
```

Brauzerda oching:

```text
http://localhost:8000
```

Admin panel:

```text
http://localhost:8000?r=auth/login
```

Demo login:

```text
Email: admin@smartedu.uz
Parol: admin123
```

## MySQLga o‘tkazish

1. MySQL bazasini yarating.
2. `data/mysql_schema.sql` faylini import qiling.
3. `config/config.php` ichidagi `dsn`, `username`, `password` qiymatlarini MySQLga moslang.

Namuna:

```php
'dsn' => 'mysql:host=localhost;dbname=smartedu;charset=utf8mb4',
'username' => 'root',
'password' => '',
```

## Yii2 bilan bog‘liqlik

Loyiha Yii2dagi asosiy g‘oyalarni amalda ko‘rsatadi: MVC tuzilma, controller, model, view, CRUD, validatsiya, login, admin panel va ma’lumotlar bazasi. To‘liq Yii2 paketiga ko‘chirishda shu modellar va viewlar Yii2 Basic yoki Advanced template ichiga joylashtiriladi.
