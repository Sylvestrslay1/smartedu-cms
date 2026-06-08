<div class="admin-head"><div><span>CMS</span><h1><?= $item ? 'Yangilikni tahrirlash' : 'Yangi yangilik' ?></h1></div></div>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Sarlavha <input name="title" required value="<?= $this->e($item['title'] ?? '') ?>"></label>
    <label>Kategoriya
        <select name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= (($item['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>><?= $this->e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Qisqa matn <textarea name="short_text" required rows="3"><?= $this->e($item['short_text'] ?? '') ?></textarea></label>
    <label>To‘liq matn <textarea name="body" required rows="7"><?= $this->e($item['body'] ?? '') ?></textarea></label>
    <label>Rasm URL <input name="image" value="<?= $this->e($item['image'] ?? '') ?>" placeholder="assets/hero-smartedu.png yoki https://..."></label>
    <label>Sana <input type="date" name="published_at" value="<?= $this->e($item['published_at'] ?? date('Y-m-d')) ?>"></label>
    <label>Status
        <select name="status">
            <option value="1" <?= (($item['status'] ?? 1) == 1) ? 'selected' : '' ?>>Faol</option>
            <option value="0" <?= (($item['status'] ?? 1) == 0) ? 'selected' : '' ?>>Yopiq</option>
        </select>
    </label>
    <label>Featured
        <select name="featured">
            <option value="1" <?= (($item['featured'] ?? 0) == 1) ? 'selected' : '' ?>>Ha</option>
            <option value="0" <?= (($item['featured'] ?? 0) == 0) ? 'selected' : '' ?>>Yo‘q</option>
        </select>
    </label>
    <button class="btn primary" type="submit">Saqlash</button>
</form>
