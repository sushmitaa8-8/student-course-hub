<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container">

        <div class="section-heading">
            <p class="eyebrow">Teaching Team</p>
            <h2>Meet the staff</h2>
        </div>

        <div class="grid grid-3">
            <?php foreach ($staff as $member): ?>
                <article class="card profile-card">
                    <div class="avatar">
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
                    <p class="muted">
                        Leads <?= (int)$member['ModuleCount'] ?> module(s)
                    </p>
                    <a class="btn btn-primary small"
                       style="margin-top: 0.75rem; display: inline-block;"
                       href="/student-course-hub/?page=staff-profile&id=<?= $member['StaffID'] ?>">
                        View Profile
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>