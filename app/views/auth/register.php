<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section auth-section">
    <div class="container auth-grid">

        <section class="card auth-info">
            <p class="eyebrow">Create Account</p>
            <h2>Register</h2>
            <p>Create an administrator account to manage the system.</p>
        </section>

        <?php if ($message != ''): ?>
            <p class="card" style="padding: 1rem;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form class="card form-card" action="/student-course-hub/index.php?page=register" method="post">

            <div class="form-row two-col">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last name">
                </div>
            </div>

            <div class="form-group">
                <label for="register_email">Email address</label>
                <input type="email" id="register_email" name="register_email" placeholder="Email address">
            </div>

            <div class="form-row two-col">
                <div class="form-group">
                    <label for="register_password">Password</label>
                    <input type="password" id="register_password" name="register_password" placeholder="Create a password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat password">
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Create Account</button>

        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>