<div class="admin-head"><div><span>CMS</span><h1><?= $category ? 'Kategoriyani tahrirlash' : 'Yangi kategoriya' ?></h1></div></div>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>Nomi <input name="name" required value="<?= $this->e($category['name'] ?? '') ?>"></label>
    <label>Turi
        <select name="type">
            <option value="course" <?= (($category['type'] ?? '') === 'course') ? 'selected' : '' ?>>Kurs</option>
            <option value="news" <?= (($category['type'] ?? 'news') === 'news') ? 'selected' : '' ?>>Yangilik</option>
        </select>
    </label>
    <label>Rang <input type="color" name="color" value="<?= $this->e($category['color'] ?? '#75f7ff') ?>"></label>
    <button class="btn primary" type="submit">Saqlash</button>
</form>
