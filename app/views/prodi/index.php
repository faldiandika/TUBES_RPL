<?php
$bgFoto = '';
if (!empty($profil['foto'])) {
    $bgFoto = e(img_url($profil['foto']));
} elseif (!empty($fakultas)) {
    foreach ($fakultas as $fItem) {
        if (!empty($fItem['foto'])) {
            $bgFoto = e(img_url($fItem['foto']));
            break;
        }
    }
}

$punyaFilterAktif = (trim((string)($q ?? '')) !== '') || ((int)($fakultasId ?? 0) > 0) || (trim((string)($jenjang ?? '')) !== '');

if (!function_exists('kelas_akreditasi')) {
    function kelas_akreditasi(string $akreditasi): string
    {
        $teks = strtolower(trim($akreditasi));
        if (str_contains($teks, 'unggul') || $teks === 'a') {
            return 'badge-unggul';
        }
        if (str_contains($teks, 'baik sekali') || str_contains($teks, 'baik')) {
            return 'badge-baik-sekali';
        }
        return 'badge-standar';
    }
}
?>

<div class="subpage-stage <?= $bgFoto ? 'has-page-bg' : '' ?>">
    <?php if ($bgFoto): ?>
        <div class="page-fixed-bg" style="background-image: url('<?= $bgFoto ?>');" aria-hidden="true"></div>
        <div class="page-fixed-overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <section class="glass-panel">
        <div class="glass-head">
            <span class="glass-eyebrow">Direktori Akademik</span>
            <h1>Program Studi</h1>
            <p>Temukan program studi yang sesuai dengan minat dan kualifikasi Anda di Universitas Tadulako.</p>
        </div>

        <form class="glass-filter" method="get" action="index.php">
            <input type="hidden" name="c" value="prodi">
            <input type="text" name="q" placeholder="Cari nama prodi (misal: Sistem Informasi)..." value="<?= e($q) ?>">

            <select name="fakultas">
                <option value="0">Semua Fakultas</option>
                <?php foreach ($fakultas as $f): ?>
                    <option value="<?= (int)$f['id'] ?>" <?= (int)$f['id'] === (int)$fakultasId ? 'selected' : '' ?>>
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

            <div class="filter-actions">
                <button class="btn btn-primary-pill" type="submit">Cari</button>
                <?php if ($punyaFilterAktif): ?>
                    <a class="btn btn-reset-pill" href="index.php?c=prodi">Reset</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="result-meta">
            <span class="count-pill"><?= count($prodi) ?> program studi ditemukan</span>
        </div>

        <?php if (!$prodi): ?>
            <div class="glass-empty">
                <p>Tidak ada program studi yang cocok dengan filter yang dipilih.</p>
                <a class="btn btn-reset-pill" href="index.php?c=prodi">Tampilkan Semua Prodi</a>
            </div>
        <?php else: ?>
            <div class="grid prodi-grid">
                <?php foreach ($prodi as $p): ?>
                    <?php
                    $akre = trim((string)($p['akreditasi'] ?? ''));
                    $badgeClass = kelas_akreditasi($akre);
                    ?>
                    <a class="glass-card prodi-card" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>">
                        <div class="prodi-top">
                            <span class="jenjang-pill"><?= e($p['jenjang']) ?></span>
                            <?php if ($akre !== ''): ?>
                                <span class="akre-badge <?= e($badgeClass) ?>"><?= e($akre) ?></span>
                            <?php endif; ?>
                        </div>
                        <h3><?= e($p['nama']) ?></h3>
                        <p class="prodi-fakultas"><?= e($p['fakultas_nama']) ?></p>
                        <div class="glass-card-foot">
                            <span class="detail-link-text">Lihat Detail</span>
                            <span class="card-arrow">&rarr;</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>