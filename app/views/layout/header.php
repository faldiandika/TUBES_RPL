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
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav class="nav">
    <a class="brand" href="index.php">Prodi Untad</a>
    <div>
        <a href="index.php">Beranda</a>
        <a href="index.php?c=fakultas">Fakultas</a>
        <a href="index.php?c=prodi">Program Studi</a>
        <a href="index.php?c=admin">Admin</a>
    </div>
</nav>
<main class="<?= e($mainClass) ?>">
```[cite: 45]

### Tambahan Kecil di `public/css/style.css`
Tambahkan aturan ini di `style.css` agar `<main class="main-home">` tidak punya margin/padding samping yang membatasi latar belakang penuh[cite: 44]:

```css
.main-home {
    position: relative;
    z-index: 2;
    width: 100%;
    margin: 0;
    padding: 0;
}
```[cite: 44]

Setelah `header.php` dan `style.css` diperbarui, tekan `Ctrl + F5` di browser untuk melihat hasilnya[cite: 44, 45]. Apakah gambar utama kampus sudah tampil penuh tanpa tepi kotak sekarang?