<section class="hero signature-hero">
    <div class="hero-grid-floor"></div>
    <div class="hero-copy">
        <span class="eyebrow">CyberGlass Edu OS</span>
        <h1><?= $this->e($settings['hero_title'] ?? 'O‘quv markazi uchun takrorlanmas CMS ekotizimi') ?></h1>
        <p><?= $this->e($settings['hero_subtitle'] ?? 'Glassmorphism, dark neon tech, 3D kartalar, AI workspace, magazine layout va gamified dashboard bitta katta SmartEdu platformasiga birlashtirildi.') ?></p>
        <div class="hero-actions">
            <a class="btn primary" href="?r=site/apply">Ariza qoldirish</a>
            <a class="btn ghost" href="?r=site/courses">Kurslarni ko‘rish</a>
        </div>
        <div class="trust-row">
            <span>Glass CMS</span>
            <span>Neon dashboard</span>
            <span>3D cards</span>
            <span>AI workspace</span>
            <span>Yii2 MVC</span>
        </div>
    </div>
    <div class="hero-visual" aria-label="SmartEdu CMS dashboard">
        <img src="assets/hero-smartedu.png" alt="SmartEdu CMS zamonaviy o‘quv markazi">
        <div class="floating-card floating-top">
            <strong>+28%</strong>
            <span>yangi arizalar</span>
        </div>
        <div class="floating-card floating-bottom">
            <strong>CMS</strong>
            <span>kontent boshqaruvi</span>
        </div>
        <div class="neon-orbit-card">
            <span>Live workspace</span>
            <strong>Yii2 + MySQL</strong>
            <i></i>
        </div>
    </div>
</section>

<section class="quick-stats">
    <div><strong>12+</strong><span>amaliy modul</span></div>
    <div><strong>100%</strong><span>CRUD amallari</span></div>
    <div><strong>4</strong><span>admin bo‘lim</span></div>
    <div><strong>24/7</strong><span>onlayn ariza</span></div>
</section>

<section class="section command-center">
    <div class="section-title">
        <span>CMS sxemasi</span>
        <h2>Bitta platformada sayt, admin panel, arizalar va kontent boshqaruvi</h2>
    </div>
    <div class="workflow-map">
        <article>
            <b>01</b>
            <h3>Foydalanuvchi sayti</h3>
            <p>Kurslar, mentorlar, yangiliklar va onlayn ariza birinchi ekrandan boshlab ko‘rinadi.</p>
        </article>
        <article>
            <b>02</b>
            <h3>CMS admin panel</h3>
            <p>Kurs, o‘qituvchi, yangilik va arizalar shaffof glass dashboard orqali boshqariladi.</p>
        </article>
        <article>
            <b>03</b>
            <h3>Ma’lumotlar bazasi</h3>
            <p>Yii2 uslubidagi Model qatlamlari MySQL yoki demo SQLite bazasi bilan ishlaydi.</p>
        </article>
        <article>
            <b>04</b>
            <h3>Natija va progress</h3>
            <p>Admin ariza statuslarini yuritadi, dashboard esa faoliyatni statistik ko‘rsatadi.</p>
        </article>
    </div>
</section>

<section class="section section-deep">
    <div class="section-title">
        <span>Kurslar</span>
        <h2>3D floating kurs kartalari</h2>
    </div>
    <div class="grid cards-3">
        <?php foreach ($courses as $course): ?>
            <article class="card course-card">
                <div class="card-top">
                    <div class="card-icon"><?= str_pad((string) ($course['id'] ?? 1), 2, '0', STR_PAD_LEFT) ?></div>
                    <span class="pill"><?= $this->e($course['category_name'] ?? 'Faol kurs') ?></span>
                </div>
                <h3><?= $this->e($course['title']) ?></h3>
                <p><?= $this->e($course['description']) ?></p>
                <?php if (!empty($course['image'])): ?><img class="card-image" src="<?= $this->e($course['image']) ?>" alt="<?= $this->e($course['title']) ?>"><?php endif; ?>
                <div class="meta">
                    <span><?= $this->e($course['duration']) ?></span>
                    <span><?= $this->e($course['price']) ?></span>
                </div>
                <a class="text-link" href="?r=site/course&slug=<?= $this->e($course['slug']) ?>">Batafsil</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section ai-workspace">
    <div class="ai-panel">
        <div>
            <span class="eyebrow">AI Assistant Style CMS</span>
            <h2>Admin uchun workspace: tezkor qaror, tezkor boshqaruv</h2>
            <p>Har bir ma’lumot chat/workspace kartasi kabi ko‘rinadi: yangi arizalar, kurs holati, kontent rejalari va operator vazifalari bitta oynada jamlanadi.</p>
        </div>
        <div class="chat-stack">
            <div><strong>CMS bot</strong><span>Bugun 3 ta yangi ariza keldi.</span></div>
            <div><strong>Operator</strong><span>PHP Yii2 kursi uchun status “Bog‘lanildi”.</span></div>
            <div><strong>Dashboard</strong><span>Kontent, kurs va mentorlar yangilandi.</span></div>
        </div>
    </div>
</section>

<section class="section band mentor-band">
    <div class="section-title">
        <span>Mentorlar</span>
        <h2>Tajribali o‘qituvchilar</h2>
    </div>
    <div class="grid cards-3">
        <?php foreach ($teachers as $teacher): ?>
            <article class="profile-card">
                <div class="avatar"><?= $this->e(substr($teacher['full_name'], 0, 1)) ?></div>
                <h3><?= $this->e($teacher['full_name']) ?></h3>
                <p><?= $this->e($teacher['specialty']) ?> · <?= (int) $teacher['experience'] ?> yil tajriba</p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section magazine-section">
    <div class="section-title">
        <span>Yangiliklar</span>
        <h2>Magazine style yangiliklar lentasi</h2>
    </div>
    <div class="news-list magazine-grid">
        <?php foreach ($news as $item): ?>
            <article class="news-item">
                <time><?= $this->e($item['published_at']) ?></time>
                <h3><?= $this->e($item['title']) ?></h3>
                <p><?= $this->e($item['short_text']) ?></p>
                <a class="text-link" href="?r=site/news-view&id=<?= (int) $item['id'] ?>">O‘qish</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section achievement-zone">
    <div class="section-title">
        <span>Gamified Dashboard</span>
        <h2>Loyiha ichida progress va achievement hissi</h2>
    </div>
    <div class="achievement-grid">
        <article><strong>10+</strong><span>ariza qabul qilish flow</span><progress value="82" max="100"></progress></article>
        <article><strong>5</strong><span>CMS CRUD moduli</span><progress value="95" max="100"></progress></article>
        <article><strong>3</strong><span>kontent kanali</span><progress value="76" max="100"></progress></article>
    </div>
</section>
