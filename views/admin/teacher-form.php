<div class="admin-head"><div><span>CMS</span><h1><?= $teacher ? 'O‘qituvchini tahrirlash' : 'Yangi o‘qituvchi' ?></h1></div></div>
<form class="form-card admin-form" method="post">
    <?= $this->csrfInput() ?>
    <label>F.I.O <input name="full_name" required value="<?= $this->e($teacher['full_name'] ?? '') ?>"></label>
    <label>Mutaxassislik <input name="specialty" required value="<?= $this->e($teacher['specialty'] ?? '') ?>"></label>
    <label>Tajriba yili <input type="number" name="experience" required value="<?= $this->e($teacher['experience'] ?? '1') ?>"></label>
    <label>Telefon <input name="phone" value="<?= $this->e($teacher['phone'] ?? '') ?>"></label>
    <label>Biografiya <textarea name="bio" rows="5"><?= $this->e($teacher['bio'] ?? '') ?></textarea></label>
    <label>Status
        <select name="status">
            <option value="1" <?= (($teacher['status'] ?? 1) == 1) ? 'selected' : '' ?>>Faol</option>
            <option value="0" <?= (($teacher['status'] ?? 1) == 0) ? 'selected' : '' ?>>Yopiq</option>
        </select>
    </label>
    <button class="btn primary" type="submit">Saqlash</button>
</form>
