<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container">

        <div class="section-heading">
            <p class="eyebrow">Programme Directory</p>
            <h2>Available degree programmes</h2>
        </div>

        <!-- Search and filter form -->
        <form class="card" style="margin-bottom: 1.5rem; padding: 1.25rem;"
              action="/student-course-hub/index.php" method="get">
            <input type="hidden" name="page" value="programmes">
            <div class="form-row two-col">
                <div class="form-group">
                    <label for="keyword">Search by keyword</label>
                    <input type="text" id="keyword" name="keyword"
                           placeholder="e.g. Cyber Security"
                           value="<?= htmlspecialchars($keyword) ?>">
                </div>
                <div class="form-group">
                    <label for="level">Filter by level</label>
                    <select id="level" name="level">
                        <option value="All Levels">All Levels</option>
                        <option value="Undergraduate" <?= $level == 'Undergraduate' ? 'selected' : '' ?>>
                            Undergraduate
                        </option>
                        <option value="Postgraduate" <?= $level == 'Postgraduate' ? 'selected' : '' ?>>
                            Postgraduate
                        </option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Search Programmes</button>
            <?php if ($keyword != '' || ($level != '' && $level != 'All Levels')): ?>
                <a href="/student-course-hub/?page=programmes"
                   class="btn btn-outline"
                   style="margin-left: 0.5rem;">
                    Clear
                </a>
            <?php endif; ?>
        </form>

        <?php if (count($programmes) == 0): ?>
            <p style="color: white;">No programmes found matching your search.</p>
        <?php else: ?>
            <div class="grid grid-3 programme-grid">
                <?php foreach ($programmes as $p): ?>
                    <article class="card programme-card">
                        <span class="tag"><?= htmlspecialchars($p['LevelName']) ?></span>
                        <h3><?= htmlspecialchars($p['ProgrammeName']) ?></h3>
                        <p><?= htmlspecialchars($p['Description']) ?></p>
                        <a class="btn btn-outline small"
                           href="/student-course-hub/?page=programme-details&id=<?= $p['ProgrammeID'] ?>">
                            View Details
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>