<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content" class="section">
    <div class="container">

        <div class="section-heading" style="text-align: center;">
            <p class="eyebrow">Admin Area</p>
            <h2>Dashboard</h2>
            <p>Logged in as <strong><?= htmlspecialchars($_SESSION['admin_name']) ?></strong></p>
        </div>

        <!-- Stats -->
        <div class="grid grid-3" style="margin-bottom: 2rem;">
            <article class="card stat-card">
                <h3><?= (int)$totalProgrammes ?></h3>
                <p>Total Programmes</p>
            </article>
            <article class="card stat-card">
                <h3><?= (int)$totalModules ?></h3>
                <p>Total Modules</p>
            </article>
            <article class="card stat-card">
                <h3><?= (int)$totalInterested ?></h3>
                <p>Interested Students</p>
            </article>
        </div>

        <!-- Add and Update Programmes -->
        <div class="grid grid-2" style="margin-bottom: 2rem;">

            <!-- Add Programme -->
            <section class="card">
                <h3>Add New Programme</h3>
                <form action="/student-course-hub/index.php?page=admin" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="form-group">
                        <label for="programme_name">Programme name</label>
                        <input type="text" id="programme_name" name="programme_name" placeholder="Enter programme name">
                    </div>
                    <div class="form-group">
                        <label for="programme_level">Level</label>
                        <select id="programme_level" name="programme_level">
                            <?php foreach ($levels as $level): ?>
                                <option value="<?= $level['LevelID'] ?>">
                                    <?= htmlspecialchars($level['LevelName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="programme_leader">Programme Leader</label>
                        <select id="programme_leader" name="programme_leader">
                            <?php foreach ($staff as $member): ?>
                                <option value="<?= $member['StaffID'] ?>">
                                    <?= htmlspecialchars($member['Name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="programme_description">Description</label>
                        <textarea id="programme_description" name="programme_description" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Add Programme</button>
                </form>
            </section>

            <!-- Update Programme -->
            <section class="card">
                <h3>Update Programme</h3>
                <form action="/student-course-hub/index.php?page=admin" method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label for="update_programme_id">Select programme</label>
                        <select id="update_programme_id" name="programme_id">
                            <?php foreach ($programmes as $p): ?>
                                <option value="<?= $p['ProgrammeID'] ?>">
                                    <?= htmlspecialchars($p['ProgrammeName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_name">New name</label>
                        <input type="text" id="update_name" name="programme_name" placeholder="Enter new name">
                    </div>
                    <div class="form-group">
                        <label for="update_level">Level</label>
                        <select id="update_level" name="programme_level">
                            <?php foreach ($levels as $level): ?>
                                <option value="<?= $level['LevelID'] ?>">
                                    <?= htmlspecialchars($level['LevelName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_leader">Programme Leader</label>
                        <select id="update_leader" name="programme_leader">
                            <?php foreach ($staff as $member): ?>
                                <option value="<?= $member['StaffID'] ?>">
                                    <?= htmlspecialchars($member['Name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_description">New description</label>
                        <textarea id="update_description" name="programme_description" rows="4" placeholder="Enter new description"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Programme</button>
                </form>
            </section>

        </div>

        <!-- Delete Programme -->
        <div class="grid grid-2" style="margin-bottom: 2rem;">

            <section class="card">
                <h3>Delete Programme</h3>
                <form action="/student-course-hub/index.php?page=admin" method="post">
                    <input type="hidden" name="action" value="delete">
                    <div class="form-group">
                        <label for="programme_id">Select programme to delete</label>
                        <select id="programme_id" name="programme_id">
                            <?php foreach ($programmes as $p): ?>
                                <option value="<?= $p['ProgrammeID'] ?>">
                                    <?= htmlspecialchars($p['ProgrammeName']) ?> — <?= htmlspecialchars($p['LevelName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-danger" type="submit">Delete Programme</button>
                </form>
            </section>

            <!-- Add Module -->
            <section class="card">
                <h3>Add New Module</h3>
                <form action="/student-course-hub/index.php?page=admin" method="post">
                    <input type="hidden" name="action" value="add_module">
                    <div class="form-group">
                        <label for="module_name">Module name</label>
                        <input type="text" id="module_name" name="module_name" placeholder="Enter module name">
                    </div>
                    <div class="form-group">
                        <label for="module_leader">Module Leader</label>
                        <select id="module_leader" name="module_leader">
                            <?php foreach ($staff as $member): ?>
                                <option value="<?= $member['StaffID'] ?>">
                                    <?= htmlspecialchars($member['Name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="module_description">Description</label>
                        <textarea id="module_description" name="module_description" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Add Module</button>
                </form>
            </section>

        </div>

          <!-- Delete Module -->
          <section class="card">
              <h3>Delete Module</h3>
              <form action="/student-course-hub/index.php?page=admin" method="post">
                  <input type="hidden" name="action" value="delete_module">
                  <div class="form-group">
                      <label for="delete_module_id">Select module to delete</label>
                      <select id="delete_module_id" name="delete_module_id">
                          <?php foreach ($modules as $m): ?>
                              <option value="<?= $m['ModuleID'] ?>">
                                  <?= htmlspecialchars($m['ModuleName']) ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <button class="btn btn-danger" type="submit">Delete Module</button>
              </form>
          </section>

        <!-- Reassign Module Leader -->
        <section class="card" style="margin-bottom: 2rem;">
            <h3>Reassign Module Leader</h3>
            <form action="/student-course-hub/index.php?page=admin" method="post">
                <input type="hidden" name="action" value="reassign_leader">
                <div class="form-row two-col">
                    <div class="form-group">
                        <label for="module_id">Select module</label>
                        <select id="module_id" name="module_id">
                            <?php foreach ($modules as $m): ?>
                                <option value="<?= $m['ModuleID'] ?>">
                                    <?= htmlspecialchars($m['ModuleName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="staff_id">Assign to</label>
                        <select id="staff_id" name="staff_id">
                            <?php foreach ($staff as $member): ?>
                                <option value="<?= $member['StaffID'] ?>">
                                    <?= htmlspecialchars($member['Name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Reassign Leader</button>
            </form>
        </section>

        <!-- Publish / Unpublish -->
        <section class="card" style="margin-bottom: 2rem;">
            <h3>Publish / Unpublish Programme</h3>
            <table>
                <thead>
                    <tr>
                        <th>Programme</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($programmes as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['ProgrammeName']) ?></td>
                            <td>
                                <?php if ($p['IsPublished'] == 1): ?>
                                    <span style="color: green; font-weight: bold;">Published</span>
                                <?php else: ?>
                                    <span style="color: red; font-weight: bold;">Unpublished</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="/student-course-hub/index.php?page=admin" method="post">
                                    <input type="hidden" name="action" value="publish">
                                    <input type="hidden" name="programme_id" value="<?= $p['ProgrammeID'] ?>">
                                    <input type="hidden" name="current_status" value="<?= $p['IsPublished'] ?>">
                                    <button class="btn <?= $p['IsPublished'] == 1 ? 'btn-danger' : 'btn-primary' ?> small" type="submit">
                                        <?= $p['IsPublished'] == 1 ? 'Unpublish' : 'Publish' ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Add Staff Member -->
        <section class="card">
            <h3>Add Staff Member</h3>
            <form action="/student-course-hub/index.php?page=admin" method="post">
                <input type="hidden" name="action" value="add_staff">
                <div class="form-group">
                    <label for="staff_name">Full name</label>
                    <input type="text" id="staff_name" name="staff_name" placeholder="e.g. Dr. Jane Smith">
                </div>
                <button class="btn btn-primary" type="submit">Add Staff Member</button>
            </form>
        </section>

        <!-- Mailing List -->
        <section class="card" style="margin-top: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="margin: 0;">Mailing List</h3>
                <a href="/student-course-hub/index.php?page=export"
                   class="btn btn-primary small">
                    Export CSV
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Programme</th>
                        <th>Registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mailingList as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['StudentName']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['ProgrammeName']) ?></td>
                            <td><?= htmlspecialchars($row['RegisteredAt']) ?></td>
                            <td>
                                <form action="/student-course-hub/index.php?page=admin" method="post">
                                    <input type="hidden" name="action" value="remove_interest">
                                    <input type="hidden" name="interest_id" value="<?= $row['InterestID'] ?>">
                                    <button class="btn btn-danger small" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>