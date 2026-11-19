<h1>Daftar Fakultas</h1>
<div class="grid">
    <?php foreach ($fakultas as $f): ?>
        <a class="card" href="index.php?c=prodi&fakultas=<?= (int)$f['id'] ?>">
            <?php if (!empty($f['foto'])): ?>
                <img class="card-img" src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
            <?php endif; ?>
            <h3><?= e($f['nama']) ?></h3>
            <small><?= (int)$f['jumlah_prodi'] ?> program studi</small>
        </a>
    <?php endforeach; ?>
</div>