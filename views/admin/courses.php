<div class="admin-head">
    <div><span>CMS</span><h1>Kurslar</h1></div>
    <a class="btn primary" href="?r=admin/course-form">Yangi kurs</a>
</div>
<form class="filter-bar" method="get">
    <input type="hidden" name="r" value="admin/courses">
    <input name="q" placeholder="Kurs yoki o‘qituvchi qidirish" value="<?= $this->e($filters['q'] ?? '') ?>">
    <select name="category_id">
        <option value="0">Barcha kategoriyalar</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= (int) $category['id'] ?>" <?= (($filters['category_id'] ?? 0) == $category['id']) ? 'selected' : '' ?>><?= $this->e($category['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="status">
        <option value="">Barcha statuslar</option>
        <option value="1" <?= (($filters['status'] ?? '') === '1') ? 'selected' : '' ?>>Faol</option>
        <option value="0" <?= (($filters['status'] ?? '') === '0') ? 'selected' : '' ?>>Yopiq</option>
    </select>
    <button class="btn primary" type="submit">Filter</button>
</form>
<table>
    <thead><tr><th>Nomi</th><th>Kategoriya</th><th>O‘qituvchi</th><th>Narxi</th><th>Ko‘rish</th><th>Status</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($courses as $course): ?>
        <tr>
            <td><?= $this->e($course['title']) ?><?= $course['featured'] ? ' ★' : '' ?></td>
            <td><span class="badge"><?= $this->e($course['category_name'] ?? 'Yo‘q') ?></span></td>
            <td><?= $this->e($course['teacher_name']) ?></td>
            <td><?= $this->e($course['price']) ?></td>
            <td><?= (int) ($course['views'] ?? 0) ?></td>
            <td><span class="badge"><?= $course['status'] ? 'Faol' : 'Yopiq' ?></span></td>
            <td class="actions">
                <a href="?r=admin/course-form&id=<?= (int) $course['id'] ?>">Tahrirlash</a>
                <a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/course-delete&id=<?= (int) $course['id'] ?>">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$courses): ?><tr><td colspan="7" class="empty-state">Kurs topilmadi.</td></tr><?php endif; ?>
    </tbody>
</table>
