<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container narrow">

        <div class="section-heading">
            <p class="eyebrow">Student Form</p>
            <h2>Withdraw interest</h2>
        </div>

        <?php if ($message != ''): ?>
            <p class="card" style="padding: 1rem; margin-bottom: 1rem;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form class="card form-card" action="/student-course-hub/index.php?page=withdraw" method="post">

            <div class="form-group">
                <label for="withdraw_email">Email address</label>
                <input type="email" id="withdraw_email" name="withdraw_email" placeholder="Enter the email you used">
            </div>

            <div class="form-group">
                <label for="withdraw_programme">Programme</label>
                <select id="withdraw_programme" name="withdraw_programme">
                    <option value="0">-- Select a programme --</option>
                    <?php foreach ($programmes as $p): ?>
                        <option value="<?= $p['ProgrammeID'] ?>">
                            <?= htmlspecialchars($p['ProgrammeName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn btn-danger" type="submit">Withdraw Interest</button>

        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>