<?php $appName = \App\Core\App::config('appName'); ?>
<!doctype html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($appName) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="public-body">
<header class="site-header">
    <a class="brand" href="?r=site/index"><span class="brand-mark">S</span> SmartEdu <span>CMS</span></a>
    <nav>
        <a href="?r=site/index">Bosh sahifa</a>
        <a href="?r=site/courses">Kurslar</a>
        <a href="?r=site/teachers">O‘qituvchilar</a>
        <a href="?r=site/news">Yangiliklar</a>
        <a href="?r=site/contact">Aloqa</a>
        <a class="nav-cta" href="?r=site/apply">Ariza qoldirish</a>
    </nav>
</header>

<main class="public-main">
    <?= $content ?>
</main>

<footer class="footer">
    <div>
        <strong>SmartEdu CMS</strong>
        <p>PHP, Yii2 uslubidagi MVC va CMS boshqaruvi asosida yaratilgan o‘quv markazi sayti.</p>
    </div>
    <a href="?r=auth/login">Admin panel</a>
</footer>
</body>
</html>
