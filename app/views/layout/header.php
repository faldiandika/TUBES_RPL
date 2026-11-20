<?php
$currentC = $_GET['c'] ?? 'home';
$mainClass = ($currentC === 'home') ? 'main-home' : 'container';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Program Studi Untad</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css?v=3">
</head>
<body class="<?= $currentC === 'home' ? 'is-home' : '' ?>">
<header class="nav-wrap">
    <nav class="nav">
        <div class="nav-left">
            <a class="brand" href="index.php">
                <span class="brand-mark" aria-hidden="true">U</span>
                <span>Prodi Untad</span>
            </a>
            <div class="nav-links">
                <a class="<?= $currentC === 'home' ? 'active' : '' ?>" href="index.php">Beranda</a>
                <a class="<?= $currentC === 'fakultas' ? 'active' : '' ?>" href="index.php?c=fakultas">Fakultas</a>
                <a class="<?= $currentC === 'prodi' ? 'active' : '' ?>" href="index.php?c=prodi">Program Studi</a>
            </div>
        </div>
        <div class="nav-right">
            <a class="nav-sub" href="index.php?c=prodi">Jelajahi Prodi &#8599;</a>
            <a class="nav-pill" href="index.php?c=admin">Admin</a>
        </div>
    </nav>
</header>
<main class="<?= e($mainClass) ?>">