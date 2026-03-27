<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container narrow">

        <div class="section-heading">
            <p class="eyebrow">Student Form</p>
            <h2>Register your interest</h2>
        </div>

        <?php if ($message != ''): ?>
            <p class="card" style="padding: 1rem; margin-bottom: 1rem;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form class="card form-card" action="/student-course-hub/index.php?page=interest" method="post">

            <div class="form-group">
                <label for="student_name">Full name</label>
                <input type="text" id="student_name" name="student_name" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address">
            </div>

            <div class="form-group">
                <label for="programme">Choose a programme</label>
                <select id="programme" name="programme">
                    <option value="0">-- Select a programme --</option>
                    <?php foreach ($programmes as $p): ?>
                        <option value="<?= $p['ProgrammeID'] ?>"
                            <?= $p['ProgrammeID'] == $selectedId ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['ProgrammeName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Submit Interest</button>

        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>