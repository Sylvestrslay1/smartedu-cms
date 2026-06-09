<section class="page-head">
    <span>Aloqa</span>
    <h1>SmartEdu bilan bog‘lanish</h1>
    <p>Telefon, manzil va ijtimoiy tarmoqlar admin paneldagi sozlamalardan boshqariladi.</p>
</section>

<section class="section contact-grid">
    <article class="info-panel">
        <h3>Kontaktlar</h3>
        <p><strong>Telefon:</strong> <?= $this->e($settings['phone'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= $this->e($settings['email'] ?? '') ?></p>
        <p><strong>Manzil:</strong> <?= $this->e($settings['address'] ?? '') ?></p>
        <p><strong>Telegram:</strong> <?= $this->e($settings['telegram'] ?? '') ?></p>
        <p><strong>Instagram:</strong> <?= $this->e($settings['instagram'] ?? '') ?></p>
    </article>

    <article class="map-card">
        <iframe
            src="https://www.google.com/maps?q=Tashkent%20Uzbekistan&output=embed"
            width="100%"
            height="320"
            style="border:0; border-radius:18px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>

        <strong>SmartEdu HQ</strong>
        <span>Toshkent · IT learning center</span>

        <a
            href="https://www.google.com/maps/search/?api=1&query=Tashkent%20Uzbekistan"
            target="_blank"
            rel="noopener"
            class="btn btn-primary">
            Lokatsiyani Google Maps’da ochish
        </a>
    </article>
</section>