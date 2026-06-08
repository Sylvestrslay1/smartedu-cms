<section class="page-head">
    <span>Onlayn qabul</span>
    <h1>Ariza qoldirish</h1>
</section>
<section class="section form-wrap">
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert success"><?= $this->e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
    <?php endif; ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert danger"><?= $this->e($error) ?></div>
    <?php endforeach; ?>
    <form class="form-card" method="post">
        <?= $this->csrfInput() ?>
        <label>Ism <input name="first_name" required></label>
        <label>Familiya <input name="last_name" required></label>
        <label>Telefon <input name="phone" required placeholder="+998 90 123 45 67"></label>
        <label>Kurs
            <select name="course_id">
                <?php foreach ($courses as $course): ?>
                    <option value="<?= (int) $course['id'] ?>"><?= $this->e($course['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Izoh <textarea name="message" rows="4"></textarea></label>
        <button class="btn primary" type="submit">Yuborish</button>
    </form>
</section>
