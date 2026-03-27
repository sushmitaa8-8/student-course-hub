<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container">

        <div class="section-heading">
            <p class="eyebrow">Modules</p>
            <h2>All modules</h2>
        </div>

        <div class="table-card card">
            <table>
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Leader</th>
                        <th>Shared?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                        <tr>
                            <td><?= htmlspecialchars($module['ModuleName']) ?></td>
                            <td><?= htmlspecialchars($module['Description']) ?></td>
                            <td><?= htmlspecialchars($module['LeaderName']) ?></td>
                            <td>
                               <?php if ($module['ProgrammeCount'] > 1): ?>
                                <span style="color: green; font-weight: bold;">
                                    Yes —
                                    <?php foreach ($module['ProgrammeNames'] as $prog): ?>
                                        <a href="/student-course-hub/?page=programme-details&id=<?= $prog['ProgrammeID'] ?>">
                                            <?= htmlspecialchars($prog['ProgrammeName']) ?>
                                        </a>&nbsp;
                                    <?php endforeach; ?>
                                </span>
                                <?php else: ?>
                                    <span style="color: var(--text-soft);">No</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>