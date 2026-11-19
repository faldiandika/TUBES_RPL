<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Prodi Untad</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav class="nav admin-nav">
    <a class="brand" href="index.php?c=admin&a=dashboard">Admin Prodi Untad</a>
    <div>
        <a href="index.php?c=admin&a=dashboard">Dashboard</a>
        <a href="index.php?c=adminfakultas">Fakultas</a>
        <a href="index.php?c=adminprodi">Program Studi</a>
        <a href="index.php?c=adminprofil">Profil Kampus</a>
        <a href="index.php" target="_blank">Lihat Situs</a>
        <a href="index.php?c=admin&a=logout">Logout (<?= e($_SESSION['admin_nama'] ?? '') ?>)</a>
    </div>
</nav>
<main class="container">
<?php if ($f = flash()): ?>
    <p class="alert <?= e($f['tipe']) ?>"><?= e($f['pesan']) ?></p>
<?php endif; ?>