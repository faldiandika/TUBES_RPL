<div class="bar">
    <h1>Kelola Fakultas</h1>
    <a class="btn" href="index.php?c=adminfakultas&a=tambah">+ Tambah Fakultas</a>
</div>

<table class="tabel">
    <tr>
        <th>No</th>
        <th>Logo</th>
        <th>Nama Fakultas</th>
        <th>Jumlah Prodi</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($fakultas as $i => $f): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td>
                <?php if (!empty($f['foto'])): ?>
                    <img class="thumb" src="<?= e(img_url($f['foto'])) ?>" alt="">
                <?php endif; ?>
            </td>
            <td><?= e($f['nama']) ?></td>
            <td><?= (int)$f['jumlah_prodi'] ?></td>
            <td>
                <a class="btn kecil" href="index.php?c=adminfakultas&a=ubah&id=<?= (int)$f['id'] ?>">Ubah</a>
                <form class="inline" method="post" action="index.php?c=adminfakultas&a=hapus"
                      onsubmit="return confirm('Menghapus fakultas ini juga akan menghapus <?= (int)$f['jumlah_prodi'] ?> program studinya. Lanjutkan?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= (int)$f['id'] ?>">
                    <button class="btn kecil bahaya" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>