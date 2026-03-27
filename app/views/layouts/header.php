<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

function isActive($routePage, $currentPage) {
    return $routePage === $currentPage ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kripa Technical Institute</title>
    <link rel="stylesheet" href="/student-course-hub/public/assets/css/style.css">
</head>
<body class="page-<?= htmlspecialchars($page) ?>">
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <header class="site-header">
        <div class="container header-inner">
            <a href="/student-course-hub/" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: white;">
                <div style="width: 42px; height: 42px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1rem; color: var(--primary); flex-shrink: 0;">
                    KTI
                </div>
                <h1 class="site-title">Kripa Technical Institute</h1>
            </a>

            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a class="<?= isActive('home', $page) ?>" href="/student-course-hub/">Home</a></li>
                    <li><a class="<?= isActive('programmes', $page) ?>" href="/student-course-hub/?page=programmes">Programmes</a></li>
                    <li><a class="<?= isActive('modules', $page) ?>" href="/student-course-hub/?page=modules">Modules</a></li>
                    <li><a class="<?= isActive('staff', $page) ?>" href="/student-course-hub/?page=staff">Staff</a></li>
                    <li><a class="<?= isActive('interest', $page) ?>" href="/student-course-hub/?page=interest">Register Interest</a></li>
                    <li><a class="<?= isActive('withdraw', $page) ?>" href="/student-course-hub/?page=withdraw">Withdraw</a></li>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                      <li><a class="<?= isActive('admin', $page) ?>" href="/student-course-hub/?page=admin">Dashboard</a></li>
                      <li><a class="<?= isActive('logout', $page) ?>" href="/student-course-hub/?page=logout">Logout</a></li>
                    <?php else: ?>
                      <li><a class="<?= isActive('login', $page) ?>" href="/student-course-hub/?page=login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>