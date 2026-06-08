<section class="page-head">
    <span><?= $this->e($item['category_name'] ?? 'Yangilik') ?></span>
    <h1><?= $this->e($item['title']) ?></h1>
    <p><?= $this->e($item['published_at']) ?> · <?= (int) ($item['views'] ?? 0) ?> ko‘rish</p>
</section>
<section class="section two-col">
    <article class="article-body">
        <?php if (!empty($item['image'])): ?><img class="article-image" src="<?= $this->e($item['image']) ?>" alt="<?= $this->e($item['title']) ?>"><?php endif; ?>
        <p class="lead"><?= $this->e($item['short_text']) ?></p>
        <p><?= nl2br($this->e($item['body'])) ?></p>
    </article>
    <aside class="info-panel">
        <h3>Onlayn qabul</h3>
        <p>Yangilik sizga qiziq bo‘lsa, mos kursga ariza qoldiring.</p>
        <a class="btn primary" href="?r=site/apply">Ariza qoldirish</a>
    </aside>
</section>
