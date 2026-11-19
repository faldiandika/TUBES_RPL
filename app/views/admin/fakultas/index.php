<?php
if (!function_exists('singkatan_fakultas_admin')) {
    function singkatan_fakultas_admin(string $nama): string
    {
        if (preg_match('/\(([A-Z]{2,8})\)/', $nama, $m)) {
            return $m[1];
        }
        $kata = preg_split('/\s+/', trim($nama));
        $huruf = '';
        foreach ($kata as $k) {
            $bersih = preg_replace('/[^A-Za-z]/', '', $k);
            if ($bersih !== '' && !in_array(strtolower($bersih), ['dan', 'ilmu', 'teknik', 'fakultas'])) {
                $huruf .= strtoupper($bersih[0]);
            }
            if (strlen($huruf) >= 3) break;
        }
        return $huruf !== '' ? $huruf : 'UNT';
    }
}
?>

<div class="bar admin-bar">
    <div>
        <span class="admin-eyebrow">Manajemen Data</span>
        <h1>Kelola Fakultas</h1>
    </div>
    <a class="btn btn-primary-pill" href="index.php?c=adminfakultas&a=tambah">+ Tambah Fakultas</a>
</div>

<div class="admin-table-card">
    <table class="tabel admin-tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Nama Fakultas</th>
                <th>Jumlah Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fakultas as $i => $f): ?>
                <?php $singkatan = singkatan_fakultas_admin((string)$f['nama']); ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php if (!empty($f['foto'])): ?>
                            <img class="thumb" src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
                        <?php else: ?>
                            <span class="admin-initial-badge"><?= e($singkatan) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= e($f['nama']) ?></strong></td>
                    <td><span class="admin-count-badge"><?= (int)$f['jumlah_prodi'] ?></span></td>
                    <td class="admin-aksi-cell">
                        <div class="admin-aksi-group">
                            <a class="btn kecil" href="index.php?c=adminfakultas&a=ubah&id=<?= (int)$f['id'] ?>">Ubah</a>
                            <form class="inline" method="post" action="index.php?c=adminfakultas&a=hapus"
                                  onsubmit="return confirm('Menghapus fakultas ini juga akan menghapus <?= (int)$f['jumlah_prodi'] ?> program studinya. Lanjutkan?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= (int)$f['id'] ?>">
                                <button class="btn kecil bahaya" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>