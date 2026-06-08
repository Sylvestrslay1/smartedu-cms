<div class="admin-head">
    <div>
        <span>Glassmorphism CMS Dashboard</span>
        <h1>CyberGlass boshqaruv markazi</h1>
    </div>
    <a class="btn primary" href="?r=admin/course-form">Yangi kurs</a>
</div>
<div class="stats-grid">
    <?php foreach ($counts as $label => $count): ?>
        <div class="stat-card">
            <span><?= $this->e($label) ?></span>
            <strong><?= (int) $count ?></strong>
            <div class="stat-line"></div>
        </div>
    <?php endforeach; ?>
</div>
<section class="admin-section admin-orbit">
    <div>
        <span class="eyebrow">Gamified CMS</span>
        <h2>Bugungi progress</h2>
        <p>Arizalar, kurslar va yangiliklar bitta neon oynada kuzatiladi.</p>
    </div>
    <div class="admin-progress">
        <label>Arizalar bilan ishlash <progress value="72" max="100"></progress></label>
        <label>Kontent yangilash <progress value="88" max="100"></progress></label>
        <label>Kurslar bazasi <progress value="96" max="100"></progress></label>
    </div>
</section>
<section class="admin-section chart-panel">
    <h2>Arizalar status diagrammasi</h2>
    <div class="mini-chart">
        <?php foreach (['Yangi', 'Ko‘rib chiqilmoqda', 'Bog‘lanildi', 'Yakunlandi'] as $status): ?>
            <?php $count = (int) ($statusCounts[$status] ?? 0); ?>
            <div>
                <span><?= $this->e($status) ?></span>
                <i style="--bar: <?= max(8, min(100, $count * 18 + 8)) ?>%"></i>
                <b><?= $count ?></b>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section class="admin-section">
    <h2>So‘nggi arizalar</h2>
    <table>
        <thead><tr><th>F.I.</th><th>Kurs</th><th>Telefon</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($applications as $item): ?>
            <tr>
                <td><?= $this->e($item['first_name'] . ' ' . $item['last_name']) ?></td>
                <td><?= $this->e($item['course_title']) ?></td>
                <td><?= $this->e($item['phone']) ?></td>
                <td><span class="badge"><?= $this->e($item['status']) ?></span></td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$applications): ?><tr><td colspan="4" class="empty-state">Hozircha ariza yo‘q.</td></tr><?php endif; ?>
        </tbody>
    </table>
</section>
