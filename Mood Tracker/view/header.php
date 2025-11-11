<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <header>
            <h1>Mood Tracker</h1>
            <nav>
                <?php if ($isLoggedIn): ?>
                    <span class="user-welcome">Halo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
                    <div class="menu-links">
                        <a href="index.php?page=home" class="<?= $currentPage == 'home' ? 'active' : '' ?>">Home</a>
                        <a href="index.php?page=moods" class="<?= $currentPage == 'moods' ? 'active' : '' ?>">Kelola Mood</a>
                        <a href="index.php?page=entries" class="<?= $currentPage == 'entries' ? 'active' : '' ?>">Catatan Harian</a>
                        <a href="index.php?page=users&action=logout" class="logout-btn">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="auth-links">
                        <a href="index.php?page=users&action=showLogin">Login</a>
                        <a href="index.php?page=users&action=showRegister">Register</a>
                    </div>
                <?php endif; ?>
            </nav>
        </header>

<main>