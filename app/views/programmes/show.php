<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container programme-layout">

        <section>
            <div class="card" style="margin-bottom: 1.5rem;">
                <span class="tag"><?= htmlspecialchars($programme['LevelName']) ?></span>
                <h2><?= htmlspecialchars($programme['ProgrammeName']) ?></h2>
                <p class="lead"><?= htmlspecialchars($programme['Description']) ?></p>
            </div>

            <div class="card" style="margin-bottom: 1.5rem;">
                <h3>Programme Leader</h3>
                <p><?= htmlspecialchars($programme['LeaderName']) ?></p>
            </div>
        </section>

        <aside class="card sidebar-card">
            <h3>Quick Actions</h3>
            <ul class="side-list">
                <li>
                    <a href="/student-course-hub/?page=interest&id=<?= $programme['ProgrammeID'] ?>">
                        Register interest
                    </a>
                </li>
                <li>
                    <a href="/student-course-hub/?page=modules">
                        See all modules
                    </a>
                </li>
                <li>
                    <a href="/student-course-hub/?page=staff">
                        View staff
                    </a>
                </li>
            </ul>
        </aside>

    </div>

    <section class="section section-muted">
        <div class="container">
            <div class="section-heading">
                <p class="eyebrow">Modules by Year</p>
                <h2>Course structure</h2>
            </div>

            <div class="grid grid-3">
                <?php foreach ($modulesByYear as $year => $modules): ?>
                    <div class="card">
                        <h3>Year <?= $year ?></h3>
                        <ul class="simple-list">
                            <?php foreach ($modules as $module): ?>
                                <li><?= htmlspecialchars($module['ModuleName']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>