<div class="admin-head"><div><span>CMS</span><h1><?= $course ? 'Kursni tahrirlash' : 'Yangi kurs' ?></h1></div></div>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Kurs nomi <input name="title" required value="<?= $this->e($course['title'] ?? '') ?>"></label>
    <label>Slug <input name="slug" value="<?= $this->e($course['slug'] ?? '') ?>" placeholder="php-yii2-cms"></label>
    <label>Kategoriya
        <select name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= (($course['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>><?= $this->e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>O‘qituvchi
        <select name="teacher_id">
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= (int) $teacher['id'] ?>" <?= (($course['teacher_id'] ?? '') == $teacher['id']) ? 'selected' : '' ?>><?= $this->e($teacher['full_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Tavsif <textarea name="description" required rows="5"><?= $this->e($course['description'] ?? '') ?></textarea></label>
    <label>Rasm URL <input name="image" value="<?= $this->e($course['image'] ?? '') ?>" placeholder="assets/hero-smartedu.png yoki https://..."></label>
    <label>Davomiyligi <input name="duration" required value="<?= $this->e($course['duration'] ?? '') ?>"></label>
    <label>Narxi <input name="price" required value="<?= $this->e($course['price'] ?? '') ?>"></label>
    <label>Status
        <select name="status">
            <option value="1" <?= (($course['status'] ?? 1) == 1) ? 'selected' : '' ?>>Faol</option>
            <option value="0" <?= (($course['status'] ?? 1) == 0) ? 'selected' : '' ?>>Yopiq</option>
        </select>
    </label>
    <label>Asosiy sahifada ajratish
        <select name="featured">
            <option value="1" <?= (($course['featured'] ?? 0) == 1) ? 'selected' : '' ?>>Ha</option>
            <option value="0" <?= (($course['featured'] ?? 0) == 0) ? 'selected' : '' ?>>Yo‘q</option>
        </select>
    </label>
    <button class="btn primary" type="submit">Saqlash</button>
</form>
