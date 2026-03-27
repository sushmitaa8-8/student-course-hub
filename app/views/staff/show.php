<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container">

        <div class="section-heading">
            <p class="eyebrow">Staff Profile</p>
            <h2><?= htmlspecialchars($member['Name']) ?></h2>
        </div>

        <div class="card" style="margin-bottom: 2rem;">
            <div class="avatar" style="margin: 0 0 1rem 0;">
                <?php
                    $parts    = explode(' ', $member['Name']);
                    $initials = '';
                    foreach ($parts as $part) {
                        $initials .= strtoupper($part[0]);
                    }
                    echo htmlspecialchars($initials);
                ?>
            </div>
            <h3><?= htmlspecialchars($member['Name']) ?></h3>
            <p class="muted">Module Leader</p>
        </div>

        <div class="section-heading">
            <h2>Modules Led</h2>
        </div>

        <?php if (count($modules) == 0): ?>
            <div class="card">
                <p>This staff member is not currently leading any modules.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-3">
                <?php foreach ($modules as $module): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($module['ModuleName']) ?></h3>
                        <p><?= htmlspecialchars($module['Description']) ?></p>
                        <?php if ($module['Programmes']): ?>
                            <p class="muted" style="margin-top: 0.75rem; font-size: 0.9rem;">
                                <strong>Taught in:</strong>
                                <?= htmlspecialchars($module['Programmes']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div style="margin-top: 2rem;">
            <a href="/student-course-hub/?page=staff" class="btn btn-outline">
                Back to Staff
            </a>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>