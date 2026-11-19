<div class="bar">
    <h1>Kelola Program Studi</h1>
    <a class="btn" href="index.php?c=adminprodi&a=tambah">+ Tambah Program Studi</a>
</div>

<?php if (!$prodi): ?>
    <p>Belum ada program studi.</p>
<?php else: ?>
<table class="tabel">
    <tr>
        <th>No</th>
        <th>Nama Program Studi</th>
        <th>Fakultas</th>
        <th>Jenjang</th>
        <th>Akreditasi</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($prodi as $i => $p): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= e($p['nama']) ?></td>
            <td><?= e($p['fakultas_nama']) ?></td>
            <td><?= e($p['jenjang']) ?></td>
            <td><?= e($p['akreditasi']) ?></td>
            <td>
                <a class="btn kecil" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>" target="_blank">Lihat</a>
                <a class="btn kecil" href="index.php?c=adminprodi&a=ubah&id=<?= (int)$p['id'] ?>">Ubah</a>
                <form class="inline" method="post" action="index.php?c=adminprodi&a=hapus"
                      onsubmit="return confirm('Hapus program studi ini?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                    <button class="btn kecil bahaya" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>