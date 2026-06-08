<div class="admin-head"><div><span>CMS</span><h1><?= $user ? 'Foydalanuvchini tahrirlash' : 'Yangi foydalanuvchi' ?></h1></div></div>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Ism <input name="name" required value="<?= $this->e($user['name'] ?? '') ?>"></label>
    <label>Email <input type="email" name="email" required value="<?= $this->e($user['email'] ?? '') ?>"></label>
    <label>Rol
        <select name="role">
            <?php foreach (['admin', 'manager', 'operator'] as $role): ?>
                <option value="<?= $role ?>" <?= (($user['role'] ?? 'operator') === $role) ? 'selected' : '' ?>><?= $role ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Parol <?= $user ? '<span class="muted">Bo‘sh qoldirilsa o‘zgarmaydi</span>' : '' ?><input type="password" name="password" <?= $user ? '' : 'required' ?>></label>
    <button class="btn primary" type="submit">Saqlash</button>
</form>
