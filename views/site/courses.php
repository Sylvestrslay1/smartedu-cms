<section class="page-head">
    <span>Kurslar</span>
    <h1>O‘quv markazidagi barcha kurslar</h1>
</section>
<section class="section">
    <form class="filter-bar public-filter" method="get">
        <input type="hidden" name="r" value="site/courses">
        <input name="q" placeholder="Kurs qidirish" value="<?= $this->e($filters['q'] ?? '') ?>">
        <select name="category_id">
            <option value="0">Barcha kategoriyalar</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= (($filters['category_id'] ?? 0) == $category['id']) ? 'selected' : '' ?>><?= $this->e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn primary" type="submit">Qidirish</button>
    </form>
    <div class="grid cards-3">
        <?php foreach ($courses as $course): ?>
            <article class="card course-card">
                <div class="card-top">
                    <div class="card-icon"><?= str_pad((string) ($course['id'] ?? 1), 2, '0', STR_PAD_LEFT) ?></div>
                    <span class="pill"><?= $this->e($course['category_name'] ?? 'Kurs') ?></span>
                </div>
                <?php if (!empty($course['image'])): ?><img class="card-image" src="<?= $this->e($course['image']) ?>" alt="<?= $this->e($course['title']) ?>"><?php endif; ?>
                <h3><?= $this->e($course['title']) ?></h3>
                <p><?= $this->e($course['description']) ?></p>
                <div class="meta">
                    <span><?= $this->e($course['duration']) ?></span>
                    <span><?= $this->e($course['price']) ?></span>
                    <span><?= (int) ($course['views'] ?? 0) ?> ko‘rish</span>
                </div>
                <p class="muted">O‘qituvchi: <?= $this->e($course['teacher_name']) ?></p>
                <a class="btn small" href="?r=site/course&slug=<?= $this->e($course['slug']) ?>">Batafsil</a>
            </article>
        <?php endforeach; ?>
        <?php if (!$courses): ?><div class="empty-state glass-empty">Kurs topilmadi.</div><?php endif; ?>
    </div>
</section>
