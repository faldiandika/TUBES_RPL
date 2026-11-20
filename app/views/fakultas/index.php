<?php
$bgFoto = '';
if (!empty($profil['foto'])) {
    $bgFoto = e(img_url($profil['foto']));
} else {
    foreach ($fakultas as $item) {
        if (!empty($item['foto'])) {
            $bgFoto = e(img_url($item['foto']));
            break;
        }
    }
}

if (!function_exists('singkatan_fakultas')) {
    function singkatan_fakultas(string $nama): string
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

<div class="subpage-stage <?= $bgFoto ? 'has-page-bg' : '' ?>">
    <?php if ($bgFoto): ?>
        <div class="page-fixed-bg" style="background-image: url('<?= $bgFoto ?>');" aria-hidden="true"></div>
        <div class="page-fixed-overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <section class="glass-panel">
        <div class="glass-head">
            <span class="glass-eyebrow">Direktori Akademik</span>
            <h1>Daftar Fakultas</h1>
            <p>Pilih fakultas di Universitas Tadulako untuk melihat daftar program studi yang tersedia.</p>
        </div>

        <div class="grid fakultas-grid">
            <?php foreach ($fakultas as $f): ?>
                <?php
                $jmlProdi = (int)($f['jumlah_prodi'] ?? 0);
                $singkatan = singkatan_fakultas((string)$f['nama']);
                ?>
                <a class="glass-card" href="index.php?c=prodi&fakultas=<?= (int)$f['id'] ?>">
                    <div class="glass-card-media">
                        <?php if (!empty($f['foto'])): ?>
                            <img src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
                        <?php else: ?>
                            <div class="glass-card-placeholder">
                                <span><?= e($singkatan) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="glass-card-body">
                        <h3><?= e($f['nama']) ?></h3>
                        <div class="glass-card-foot">
                            <span class="prodi-pill"><?= $jmlProdi ?> program studi</span>
                            <span class="card-arrow">&rarr;</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
</div>