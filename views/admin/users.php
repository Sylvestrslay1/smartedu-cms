<div class="admin-head">
    <div><span>CMS</span><h1>Foydalanuvchilar</h1></div>
    <a class="btn primary" href="?r=admin/user-form">Yangi foydalanuvchi</a>
</div>
<table>
    <thead><tr><th>Ism</th><th>Email</th><th>Rol</th><th>Sana</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->e($user['name']) ?></td>
            <td><?= $this->e($user['email']) ?></td>
            <td><span class="badge"><?= $this->e($user['role']) ?></span></td>
            <td><?= $this->e($user['created_at']) ?></td>
            <td class="actions">
                <a href="?r=admin/user-form&id=<?= (int) $user['id'] ?>">Tahrirlash</a>
                <a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/user-delete&id=<?= (int) $user['id'] ?>">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
