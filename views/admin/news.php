<div class="admin-head">
    <div><span>CMS</span><h1>Yangiliklar</h1></div>
    <a class="btn primary" href="?r=admin/news-form">Yangi yangilik</a>
</div>
<form class="filter-bar" method="get">
    <input type="hidden" name="r" value="admin/news">
    <input name="q" placeholder="Yangilik qidirish" value="<?= $this->e($filters['q'] ?? '') ?>">
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
    <thead><tr><th>Sarlavha</th><th>Kategoriya</th><th>Sana</th><th>Ko‘rish</th><th>Status</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($news as $item): ?>
        <tr>
            <td><?= $this->e($item['title']) ?><?= $item['featured'] ? ' ★' : '' ?></td>
            <td><?= $this->e($item['category_name']) ?></td>
            <td><?= $this->e($item['published_at']) ?></td>
            <td><?= (int) ($item['views'] ?? 0) ?></td>
            <td><span class="badge"><?= $item['status'] ? 'Faol' : 'Yopiq' ?></span></td>
            <td class="actions">
                <a href="?r=admin/news-form&id=<?= (int) $item['id'] ?>">Tahrirlash</a>
                <a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/news-delete&id=<?= (int) $item['id'] ?>">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$news): ?><tr><td colspan="6" class="empty-state">Yangilik topilmadi.</td></tr><?php endif; ?>
    </tbody>
</table>
