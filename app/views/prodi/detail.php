<?php
$baris = [
    'Fakultas'         => $prodi['fakultas_nama'] ?? '',
    'Jenjang'          => $prodi['jenjang'] ?? '',
    'Akreditasi'       => $prodi['akreditasi'] ?? '',
    'Gelar Lulusan'    => $prodi['gelar_lulusan'] ?? '',
    'UKT'              => $prodi['ukt'] ?? '',
    'Visi & Misi'      => $prodi['visi_misi'] ?? '',
    'Kurikulum'        => $prodi['kurikulum'] ?? '',
    'Prospek Kerja'    => $prodi['prospek_kerja'] ?? '',
    'Jalur Penerimaan' => $prodi['jalur_penerimaan'] ?? '',
];
$fotoGedung = $prodi['foto_gedung'] ?? '';
$mapsUrl    = maps_url($prodi['maps_embed_url'] ?? '');

$bgFoto = '';
if (!empty($fotoGedung)) {
    $bgFoto = e(img_url($fotoGedung));
} elseif (!empty($profil['foto'])) {
    $bgFoto = e(img_url($profil['foto']));
}

$akre = trim((string)($prodi['akreditasi'] ?? ''));
$teksAkre = strtolower($akre);
$badgeClass = 'badge-standar';
if (str_contains($teksAkre, 'unggul') || $teksAkre === 'a') {
    $badgeClass = 'badge-unggul';
} elseif (str_contains($teksAkre, 'baik sekali') || str_contains($teksAkre, 'baik')) {
    $badgeClass = 'badge-baik-sekali';
}
?>

<div class="subpage-stage <?= $bgFoto ? 'has-page-bg' : '' ?>">
    <?php if ($bgFoto): ?>
        <div class="page-fixed-bg" style="background-image: url('<?= $bgFoto ?>');" aria-hidden="true"></div>
        <div class="page-fixed-overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <section class="glass-panel detail-panel">
        <div class="detail-topbar">
            <a class="btn-back-pill" href="index.php?c=prodi">&larr; Kembali ke Daftar Prodi</a>
            <div class="detail-badges">
                <?php if (!empty($prodi['jenjang'])): ?>
                    <span class="jenjang-pill"><?= e($prodi['jenjang']) ?></span>
                <?php endif; ?>
                <?php if ($akre !== ''): ?>
                    <span class="akre-badge <?= e($badgeClass) ?>">Akreditasi <?= e($akre) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="detail-header">
            <?php if (!empty($prodi['fakultas_nama'])): ?>
                <span class="glass-eyebrow"><?= e($prodi['fakultas_nama']) ?></span>
            <?php endif; ?>
            <h1><?= e($prodi['nama']) ?> (<?= e($prodi['jenjang']) ?>)</h1>
            <?php if (trim((string)($prodi['deskripsi'] ?? '')) !== ''): ?>
                <p class="detail-desc"><?= nl2br(e($prodi['deskripsi'])) ?></p>
            <?php endif; ?>
        </div>

        <?php if ($fotoGedung): ?>
            <div class="detail-media">
                <img class="detail-img" src="<?= e(img_url($fotoGedung)) ?>" alt="Gedung <?= e($prodi['nama']) ?>">
            </div>
        <?php endif; ?>

        <div class="detail-table-wrap">
            <table class="detail glass-detail">
                <?php foreach ($baris as $label => $isi): ?>
                    <?php if (trim((string)$isi) !== ''): ?>
                        <tr>
                            <th><?= e($label) ?></th>
                            <td><?= nl2br(e($isi)) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>

        <?php if ($mapsUrl): ?>
            <div class="detail-maps-wrap">
                <h2>Lokasi Program Studi</h2>
                <iframe class="maps" src="<?= e($mapsUrl) ?>"
                        loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        <?php endif; ?>
    </section>
</div>