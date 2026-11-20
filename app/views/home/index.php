<?php
$heroFoto = !empty($profil['foto']) ? e(img_url($profil['foto'])) : '';

if (!function_exists('singkatan_fakultas_home')) {
    function singkatan_fakultas_home(string $nama): string
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
<div class="home-page <?= $heroFoto ? 'has-hero-bg' : '' ?>">
    <?php if ($heroFoto): ?>
        <div class="hero-fixed-bg" id="hero-bg" style="background-image: url('<?= $heroFoto ?>');" aria-hidden="true"></div>
        <div class="hero-fixed-overlay" id="hero-overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <section class="hero-stage" id="profil-slide">
        <div class="hero-content hero-enter">
            <span class="hero-eyebrow">Profil Kampus</span>
            <h1><?= e($profil['nama']) ?></h1>
            <p><?= nl2br(e($profil['deskripsi'])) ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary-pill" href="index.php?c=prodi">Cari Program Studi</a>
                <a class="btn btn-ghost-pill" href="#jelajahi-fakultas">Jelajahi Fakultas &rarr;</a>
            </div>
        </div>
    </section>

    <div class="home-foreground">
        <section id="jelajahi-fakultas" class="surface-section home-fakultas-blue slide-panel reveal-on-scroll">
            <div class="section-head">
                <span class="blue-section-eyebrow">Direktori Akademik</span>
                <h2>Jelajahi Fakultas Kami</h2>
                <p>Pilih fakultas untuk melihat informasi dan program studi yang tersedia.</p>
            </div>
            <div class="grid home-fakultas-grid">
                <?php foreach ($fakultas as $f): ?>
                    <?php
                    $jmlProdi = (int)($f['jumlah_prodi'] ?? 0);
                    $singkatan = singkatan_fakultas_home((string)$f['nama']);
                    ?>
                    <a class="home-fakultas-card smooth-link" href="index.php?c=prodi&fakultas=<?= (int)$f['id'] ?>">
                        <div class="home-fakultas-media">
                            <?php if (!empty($f['foto'])): ?>
                                <img src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
                            <?php else: ?>
                                <div class="home-fakultas-placeholder">
                                    <span><?= e($singkatan) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="home-fakultas-body">
                            <h3><?= e($f['nama']) ?></h3>
                            <div class="home-fakultas-foot">
                                <span class="home-prodi-badge"><?= $jmlProdi ?> program studi</span>
                                <span class="home-card-arrow">&rarr;</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="surface-section slide-panel reveal-on-scroll">
            <div class="section-head">
                <h2>Program Studi Pilihan</h2>
                <p>Beberapa program studi unggulan yang dapat Anda jelajahi lebih lanjut.</p>
            </div>
            <div class="grid">
                <?php foreach ($prodi as $p): ?>
                    <a class="card smooth-link" href="index.php?c=prodi&a=detail&id=<?= (int)$p['id'] ?>">
                        <h3><?= e($p['nama']) ?> (<?= e($p['jenjang']) ?>)</h3>
                        <p><?= e($p['fakultas_nama']) ?> · Akreditasi <?= e($p['akreditasi']) ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const heroContent = document.querySelector('.hero-content');
    const heroStage = document.querySelector('.hero-stage');
    const heroBg = document.getElementById('hero-bg');
    const heroOverlay = document.getElementById('hero-overlay');

    requestAnimationFrame(() => {
        if (heroContent) heroContent.classList.add('is-ready');
    });

    function syncHeroScroll() {
        if (!heroStage) return;
        const limit = Math.max(heroStage.offsetHeight * 0.65, 280);
        const progress = Math.min(Math.max(window.scrollY / limit, 0), 1);

        if (heroContent) {
            heroContent.style.opacity = String(1 - progress * 1.15);
            heroContent.style.transform = `translateY(${-progress * 42}px)`;
        }

        if (heroBg) {
            const scale = 1 + progress * 0.14;
            const blur = progress * 10;
            heroBg.style.transform = `scale(${scale.toFixed(4)})`;
            heroBg.style.filter = `blur(${blur.toFixed(2)}px)`;
        }

        if (heroOverlay) {
            const darkness = 0.44 + progress * 0.36;
            heroOverlay.style.background = `linear-gradient(
                to bottom,
                rgba(10, 17, 30, ${darkness.toFixed(2)}) 0%,
                rgba(10, 17, 30, ${(darkness + 0.18).toFixed(2)}) 60%,
                rgba(10, 17, 30, 0.90) 100%
            )`;
        }
    }

    window.addEventListener('scroll', syncHeroScroll, { passive: true });
    syncHeroScroll();

    const items = document.querySelectorAll('.reveal-on-scroll');
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14 });
        items.forEach((el) => io.observe(el));
    } else {
        items.forEach((el) => el.classList.add('is-visible'));
    }

    document.querySelectorAll('a.smooth-link').forEach((link) => {
        link.addEventListener('click', function (e) {
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
            const href = this.getAttribute('href');
            if (!href) return;
            e.preventDefault();
            document.body.classList.add('is-leaving');
            setTimeout(() => {
                window.location.href = href;
            }, 220);
        });
    });
});
</script>