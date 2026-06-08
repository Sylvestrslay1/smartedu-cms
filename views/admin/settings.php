<div class="admin-head"><div><span>CMS</span><h1>Sayt sozlamalari</h1></div></div>
<?php if (!empty($_SESSION['flash'])): ?><div class="alert success"><?= $this->e($_SESSION['flash']); unset($_SESSION['flash']); ?></div><?php endif; ?>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Sayt nomi <input name="settings[site_name]" value="<?= $this->e($settings['site_name'] ?? '') ?>"></label>
    <label>Hero sarlavha <input name="settings[hero_title]" value="<?= $this->e($settings['hero_title'] ?? '') ?>"></label>
    <label>Hero matn <textarea name="settings[hero_subtitle]" rows="4"><?= $this->e($settings['hero_subtitle'] ?? '') ?></textarea></label>
    <label>Telefon <input name="settings[phone]" value="<?= $this->e($settings['phone'] ?? '') ?>"></label>
    <label>Email <input name="settings[email]" value="<?= $this->e($settings['email'] ?? '') ?>"></label>
    <label>Manzil <input name="settings[address]" value="<?= $this->e($settings['address'] ?? '') ?>"></label>
    <label>Telegram <input name="settings[telegram]" value="<?= $this->e($settings['telegram'] ?? '') ?>"></label>
    <label>Instagram <input name="settings[instagram]" value="<?= $this->e($settings['instagram'] ?? '') ?>"></label>
    <button class="btn primary" type="submit">Sozlamalarni saqlash</button>
</form>
