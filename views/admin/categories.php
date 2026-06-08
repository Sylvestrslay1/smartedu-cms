<div class="admin-head">
    <div><span>CMS</span><h1>Kategoriyalar</h1></div>
    <a class="btn primary" href="?r=admin/category-form">Yangi kategoriya</a>
</div>
<table>
    <thead><tr><th>Nomi</th><th>Turi</th><th>Rangi</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $this->e($category['name']) ?></td>
            <td><span class="badge"><?= $this->e($category['type']) ?></span></td>
            <td><span class="color-dot" style="--dot: <?= $this->e($category['color'] ?? '#75f7ff') ?>"></span><?= $this->e($category['color'] ?? '') ?></td>
            <td class="actions">
                <a href="?r=admin/category-form&id=<?= (int) $category['id'] ?>">Tahrirlash</a>
                <a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/category-delete&id=<?= (int) $category['id'] ?>">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
