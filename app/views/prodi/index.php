<h1>Program Studi</h1>

<form class="filter" method="get" action="index.php">
    <input type="hidden" name="c" value="prodi">
    <input type="text" name="q" placeholder="Cari nama prodi..." value="<?= e($q) ?>">

    <select name="fakultas">
        <option value="0">Semua Fakultas</option>
        <?php foreach ($fakultas as $f): ?>
            <option value="<?= (int)$f['id'] ?>" <?= (int)$f['id'] === $fakultasId ? 'selected' : '' ?>>
                <?= e($f['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="jenjang">
        <option value="">Semua Jenjang</option>
        <?php foreach ($jenjangList as $j): ?>
            <option value="<?= e($j) ?>" <?= $j === $jenjang ? 'selected' : '' ?>><?= e($j) ?></option>
        <?php endforeach; ?>
    </select>

    <button class="btn" type="submit">Cari</button>
</form>

<p><?= count($prodi) ?> program studi ditemukan.</p>

<?php if (!$prodi): ?>
    <p>Tidak ada program studi yang cocok.</p>
<?php else: ?>
    <div class="grid">
        <?php foreach ($prodi as $p): ?>
            <a class="card" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>">
                <h3><?= e($p['nama']) ?> (<?= e($p['jenjang']) ?>)</h3>
                <p><?= e($p['fakultas_nama']) ?></p>
                <small>Akreditasi <?= e($p['akreditasi']) ?></small>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>