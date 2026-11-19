<?php
if (!function_exists('kelas_akreditasi_admin')) {
    function kelas_akreditasi_admin(string $akreditasi): string
    {
        $teks = strtolower(trim($akreditasi));
        if (str_contains($teks, 'unggul') || $teks === 'a') {
            return 'admin-badge-unggul';
        }
        if (str_contains($teks, 'baik sekali') || str_contains($teks, 'baik')) {
            return 'admin-badge-baik';
        }
        return 'admin-badge-standar';
    }
}
?>

<div class="bar admin-bar">
    <div>
        <span class="admin-eyebrow">Manajemen Data</span>
        <h1>Kelola Program Studi</h1>
    </div>
    <a class="btn btn-primary-pill" href="index.php?c=adminprodi&a=tambah">+ Tambah Program Studi</a>
</div>

<?php if (!$prodi): ?>
    <div class="admin-empty-card">
        <p>Belum ada program studi.</p>
    </div>
<?php else: ?>
<div class="admin-table-card">
    <table class="tabel admin-tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Program Studi</th>
                <th>Fakultas</th>
                <th>Jenjang</th>
                <th>Akreditasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prodi as $i => $p): ?>
                <?php
                $akre = trim((string)($p['akreditasi'] ?? ''));
                $badgeClass = kelas_akreditasi_admin($akre);
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><strong><?= e($p['nama']) ?></strong></td>
                    <td><?= e($p['fakultas_nama']) ?></td>
                    <td><span class="admin-jenjang-badge"><?= e($p['jenjang']) ?></span></td>
                    <td>
                        <?php if ($akre !== ''): ?>
                            <span class="admin-akre-badge <?= e($badgeClass) ?>"><?= e($akre) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="admin-aksi-cell">
                        <div class="admin-aksi-group">
                            <a class="btn kecil" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>" target="_blank">Lihat</a>
                            <a class="btn kecil" href="index.php?c=adminprodi&a=ubah&id=<?= (int)$p['id'] ?>">Ubah</a>
                            <form class="inline" method="post" action="index.php?c=adminprodi&a=hapus"
                                  onsubmit="return confirm('Hapus program studi ini?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                                <button class="btn kecil bahaya" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>