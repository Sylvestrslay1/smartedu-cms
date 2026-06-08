<section class="page-head">
    <span>Jamoa</span>
    <h1>O‘qituvchilar ro‘yxati</h1>
</section>
<section class="section">
    <div class="grid cards-3">
        <?php foreach ($teachers as $teacher): ?>
            <article class="profile-card">
                <div class="avatar"><?= $this->e(substr($teacher['full_name'], 0, 1)) ?></div>
                <h3><?= $this->e($teacher['full_name']) ?></h3>
                <p><?= $this->e($teacher['specialty']) ?></p>
                <p class="muted"><?= (int) $teacher['experience'] ?> yil tajriba · <?= $this->e($teacher['phone']) ?></p>
                <p><?= $this->e($teacher['bio']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
