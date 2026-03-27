<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section auth-section">
    <div class="container auth-grid">

        <section class="card auth-info">
            <p class="eyebrow">Access Portal</p>
            <h2>Login</h2>
            <p>Administrator login for managing programmes and viewing the mailing list.</p>
        </section>

        <?php if ($message != ''): ?>
            <p class="card" style="padding: 1rem;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form class="card form-card" action="/student-course-hub/index.php?page=login" method="post">

            <div class="form-group">
                <label for="login_email">Username</label>
                <input type="text" id="login_email" name="login_email" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="login_password" placeholder="Enter your password">
            </div>

            <button class="btn btn-primary" type="submit">Login</button>

        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>