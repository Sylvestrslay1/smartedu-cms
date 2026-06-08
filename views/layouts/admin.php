<?php $user = \App\Core\Auth::user(); ?>
<!doctype html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | SmartEdu CMS</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="admin-body">
<aside class="admin-sidebar">
    <a class="brand admin-brand" href="?r=admin/dashboard"><span class="brand-mark">S</span> SmartEdu <span>CMS</span></a>
    <?php if ($user): ?>
        <a href="?r=admin/dashboard">Dashboard</a>
        <a href="?r=admin/courses">Kurslar</a>
        <a href="?r=admin/teachers">O‘qituvchilar</a>
        <a href="?r=admin/applications">Arizalar</a>
        <a href="?r=admin/news">Yangiliklar</a>
        <a href="?r=admin/categories">Kategoriyalar</a>
        <a href="?r=admin/users">Foydalanuvchilar</a>
        <a href="?r=admin/settings">Sozlamalar</a>
        <a href="?r=admin/profile">Profil</a>
        <a href="?r=site/index">Saytga o‘tish</a>
        <a href="?r=auth/logout">Chiqish</a>
    <?php endif; ?>
</aside>
<main class="admin-main">
    <?= $content ?>
</main>
</body>
</html>
