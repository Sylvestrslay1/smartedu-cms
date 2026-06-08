<section class="page-head">
    <span>Blog</span>
    <h1>Yangiliklar va e’lonlar</h1>
</section>
<section class="section">
    <form class="filter-bar public-filter" method="get">
        <input type="hidden" name="r" value="site/news">
        <input name="q" placeholder="Yangilik qidirish" value="<?= $this->e($filters['q'] ?? '') ?>">
        <select name="category_id">
            <option value="0">Barcha kategoriyalar</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= (($filters['category_id'] ?? 0) == $category['id']) ? 'selected' : '' ?>><?= $this->e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn primary" type="submit">Qidirish</button>
    </form>
    <div class="news-list magazine-grid">
        <?php foreach ($news as $item): ?>
            <article class="news-item">
                <time><?= $this->e($item['published_at']) ?> · <?= $this->e($item['category_name']) ?></time>
                <h3><?= $this->e($item['title']) ?></h3>
                <p><?= $this->e($item['short_text']) ?></p>
                <a class="text-link" href="?r=site/news-view&id=<?= (int) $item['id'] ?>">Batafsil o‘qish</a>
            </article>
        <?php endforeach; ?>
        <?php if (!$news): ?><div class="empty-state glass-empty">Yangilik topilmadi.</div><?php endif; ?>
    </div>
</section>
