<section class="login-panel">
    <form class="form-card login-card" method="post">
        <h1>Admin panel</h1>
        <p class="muted">Demo: admin@smartedu.uz / admin123</p>
        <?php if ($error): ?><div class="alert danger"><?= $this->e($error) ?></div><?php endif; ?>
        <label>Email <input type="email" name="email" required value="admin@smartedu.uz"></label>
        <label>Parol <input type="password" name="password" required value="admin123"></label>
        <button class="btn primary" type="submit">Kirish</button>
    </form>
</section>
