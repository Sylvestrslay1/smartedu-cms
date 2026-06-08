<section class="page-head">
    <span>Kurs haqida</span>
    <h1><?= $this->e($course['title']) ?></h1>
</section>
<section class="section two-col">
    <article>
        <h2>Kurs tavsifi</h2>
        <p><?= $this->e($course['description']) ?></p>
        <p><strong>Davomiyligi:</strong> <?= $this->e($course['duration']) ?></p>
        <p><strong>Narxi:</strong> <?= $this->e($course['price']) ?></p>
        <p><strong>O‘qituvchi:</strong> <?= $this->e($course['teacher_name']) ?></p>
    </article>
    <aside class="info-panel">
        <h3>Ro‘yxatdan o‘tish</h3>
        <p>Ushbu kurs bo‘yicha o‘qishni boshlash uchun onlayn ariza qoldiring.</p>
        <a class="btn primary" href="?r=site/apply">Ariza qoldirish</a>
    </aside>
</section>
