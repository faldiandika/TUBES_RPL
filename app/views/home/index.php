<?php
$heroFoto = !empty($profil['foto']) ? e(img_url($profil['foto'])) : '';
?>
<div class="home-page <?= $heroFoto ? 'has-hero-bg' : '' ?>">
    <?php if ($heroFoto): ?>
        <div class="hero-fixed-bg" style="background-image: url('<?= $heroFoto ?>');" aria-hidden="true"></div>
        <div class="hero-fixed-overlay" aria-hidden="true"></div>
    <?php endif; ?>

    <section class="hero-stage" id="profil-slide">
        <div class="hero-content hero-enter">
            <span class="hero-eyebrow">Profil Kampus</span>
            <h1><?= e($profil['nama']) ?></h1>
            <p><?= nl2br(e($profil['deskripsi'])) ?></p>
            <div class="hero-actions">
                <a class="btn" href="index.php?c=prodi">Cari Program Studi</a>
                <a class="btn btn-ghost" href="#jelajahi-fakultas">Jelajahi Fakultas</a>
            </div>
        </div>
    </section>

    <div class="home-foreground">
        <section id="jelajahi-fakultas" class="surface-section slide-panel reveal-on-scroll">
            <div class="section-head">
                <h2>Jelajahi Fakultas Kami</h2>
                <p>Pilih fakultas untuk melihat informasi dan program studi yang tersedia.</p>
            </div>
            <div class="grid">
                <?php foreach ($fakultas as $f): ?>
                    <a class="card smooth-link" href="index.php?c=prodi&fakultas=<?= (int)$f['id'] ?>">
                        <?php if (!empty($f['foto'])): ?>
                            <img class="card-img" src="<?= e(img_url($f['foto'])) ?>" alt="<?= e($f['nama']) ?>">
                        <?php endif; ?>
                        <h3><?= e($f['nama']) ?></h3>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="surface-section slide-panel reveal-on-scroll">
            <div class="section-head">
                <h2>Program Studi Pilihan</h2>
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

    requestAnimationFrame(() => {
        if (heroContent) heroContent.classList.add('is-ready');
    });

    function syncHeroFade() {
        if (!heroContent || !heroStage) return;
        const limit = Math.max(heroStage.offsetHeight * 0.45, 220);
        const progress = Math.min(Math.max(window.scrollY / limit, 0), 1);
        heroContent.style.opacity = String(1 - progress);
        heroContent.style.transform = `translateY(${-progress * 44}px)`;
    }

    window.addEventListener('scroll', syncHeroFade, { passive: true });
    syncHeroFade();

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