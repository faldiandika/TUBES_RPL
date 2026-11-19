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
?>
<a href="index.php?c=prodi">&larr; Kembali</a>
<h1><?= e($prodi['nama']) ?> (<?= e($prodi['jenjang']) ?>)</h1>
<p><?= nl2br(e($prodi['deskripsi'] ?? '')) ?></p>

<?php if ($fotoGedung): ?>
    <img class="detail-img" src="<?= e(img_url($fotoGedung)) ?>" alt="Gedung <?= e($prodi['nama']) ?>">
<?php endif; ?>

<table class="detail">
    <?php foreach ($baris as $label => $isi): ?>
        <?php if (trim((string)$isi) !== ''): ?>
            <tr>
                <th><?= e($label) ?></th>
                <td><?= nl2br(e($isi)) ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<?php if ($mapsUrl): ?>
    <h2>Lokasi</h2>
    <iframe class="maps" src="<?= e($mapsUrl) ?>"
            loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
<?php endif; ?>