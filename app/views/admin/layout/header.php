<?php
$currentC = $_GET['c'] ?? 'admin';
$currentA = $_GET['a'] ?? '';
$isDashboard = ($currentC === 'admin' && ($currentA === '' || $currentA === 'dashboard'));
$isFakultas  = ($currentC === 'adminfakultas');
$isProdi     = ($currentC === 'adminprodi');
$isProfil    = ($currentC === 'adminprofil');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Prodi Untad</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="admin-body">
<header class="admin-nav-wrap">
    <nav class="admin-nav">
        <div class="admin-nav-left">
            <a class="admin-brand" href="index.php?c=admin&a=dashboard">
                <span>Admin Prodi Untad</span>
                <span class="admin-brand-accent" aria-hidden="true"></span>
            </a>
            <div class="admin-nav-links">
                <a class="<?= $isDashboard ? 'active' : '' ?>" href="index.php?c=admin&a=dashboard">Dashboard</a>
                <a class="<?= $isFakultas ? 'active' : '' ?>" href="index.php?c=adminfakultas">Fakultas</a>
                <a class="<?= $isProdi ? 'active' : '' ?>" href="index.php?c=adminprodi">Program Studi</a>
                <a class="<?= $isProfil ? 'active' : '' ?>" href="index.php?c=adminprofil">Profil Kampus</a>
            </div>
        </div>
        <div class="admin-nav-right">
            <a class="admin-site-link" href="index.php" target="_blank">Lihat Situs</a>
            <a class="admin-logout-pill" href="index.php?c=admin&a=logout">Logout (<?= e($_SESSION['admin_nama'] ?? '') ?>)</a>
        </div>
    </nav>
</header>
<main class="container admin-container">
<?php if ($pesanFlash = flash()): ?>
    <p class="alert <?= e($pesanFlash['tipe']) ?>"><?= e($pesanFlash['pesan']) ?></p>
<?php endif; ?>