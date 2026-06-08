<div class="admin-head"><div><span>CMS</span><h1>Arizalar</h1></div></div>
<form class="filter-bar" method="get">
    <input type="hidden" name="r" value="admin/applications">
    <input name="q" placeholder="Ism, telefon yoki izoh qidirish" value="<?= $this->e($filters['q'] ?? '') ?>">
    <select name="course_id">
        <option value="0">Barcha kurslar</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?= (int) $course['id'] ?>" <?= (($filters['course_id'] ?? 0) == $course['id']) ? 'selected' : '' ?>><?= $this->e($course['title']) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="status">
        <option value="">Barcha statuslar</option>
        <?php foreach (['Yangi', 'Ko‘rib chiqilmoqda', 'Bog‘lanildi', 'Yakunlandi'] as $status): ?>
            <option value="<?= $this->e($status) ?>" <?= (($filters['status'] ?? '') === $status) ? 'selected' : '' ?>><?= $this->e($status) ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn primary" type="submit">Filter</button>
</form>
<table>
    <thead><tr><th>F.I.</th><th>Kurs</th><th>Telefon</th><th>Izoh</th><th>Status</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($applications as $item): ?>
        <tr>
            <td><?= $this->e($item['first_name'] . ' ' . $item['last_name']) ?></td>
            <td><?= $this->e($item['course_title']) ?></td>
            <td><?= $this->e($item['phone']) ?></td>
            <td><?= $this->e($item['message']) ?></td>
            <td>
                <form method="post" action="?r=admin/application-status" class="inline-form">
                    <?= $this->csrfInput() ?>
                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                    <select name="status" onchange="this.form.submit()">
                        <?php foreach (['Yangi', 'Ko‘rib chiqilmoqda', 'Bog‘lanildi', 'Yakunlandi'] as $status): ?>
                            <option <?= $item['status'] === $status ? 'selected' : '' ?>><?= $this->e($status) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </td>
            <td><a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/application-delete&id=<?= (int) $item['id'] ?>">O‘chirish</a></td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$applications): ?><tr><td colspan="6" class="empty-state">Ariza topilmadi.</td></tr><?php endif; ?>
    </tbody>
</table>
