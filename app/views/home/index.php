<section class="hero">
    <?php if (!empty($profil['foto'])): ?>
        <img class="hero-img" src="<?= e(img_url($profil['foto'])) ?>" alt="<?= e($profil['nama']) ?>">
    <?php endif; ?>
    <h1><?= e($profil['nama']) ?></h1>
    <p><?= e($profil['deskripsi']) ?></p>
    <a class="btn" href="index.php?c=prodi">Cari Program Studi</a>
</section>

<h2>Fakultas</h2>
<div class="grid">
    <?php foreach ($fakultas as $f): ?>
        <a class="card" href="index.php?c=prodi&fakultas=<?= (int)$f['id'] ?>">
            <?php if (!empty($f['foto'])): ?>
                <img class="card-img" src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
            <?php endif; ?>
            <h3><?= e($f['nama']) ?></h3>
        </a>
    <?php endforeach; ?>
</div>

<h2>Program Studi Pilihan</h2>
<div class="grid">
    <?php foreach ($prodi as $p): ?>
        <a class="card" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>">
            <h3><?= e($p['nama']) ?> (<?= e($p['jenjang']) ?>)</h3>
            <p><?= e($p['fakultas_nama']) ?> · Akreditasi <?= e($p['akreditasi']) ?></p>
        </a>
    <?php endforeach; ?>
</div>