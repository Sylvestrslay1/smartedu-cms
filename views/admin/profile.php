<div class="admin-head"><div><span>CMS</span><h1>Profil</h1></div></div>
<?php if ($message): ?><div class="alert success"><?= $this->e($message) ?></div><?php endif; ?>
<section class="admin-section profile-panel">
    <div class="avatar"><?= $this->e(substr($user['name'] ?? 'A', 0, 1)) ?></div>
    <div>
        <h2><?= $this->e($user['name'] ?? '') ?></h2>
        <p><?= $this->e($user['email'] ?? '') ?> · <?= $this->e($user['role'] ?? '') ?></p>
    </div>
</section>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Yangi parol <input type="password" name="password" required></label>
    <button class="btn primary" type="submit">Parolni almashtirish</button>
</form>
