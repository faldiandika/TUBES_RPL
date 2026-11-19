<div class="admin-page-head">
    <span class="admin-eyebrow">Panel Kontrol Untad</span>
    <h1>Dashboard</h1>
    <p>Selamat datang, <strong><?= e($_SESSION['admin_nama'] ?? '') ?></strong>.</p>
</div>

<div class="grid admin-dash-grid">
    <a class="admin-stat-card accent-blue" href="index.php?c=adminfakultas">
        <div class="admin-stat-top">
            <span class="admin-stat-num"><?= (int)$jumlahFakultas ?></span>
            <span class="admin-stat-badge">Untad</span>
        </div>
        <p class="admin-stat-label">Fakultas</p>
        <span class="admin-stat-hint">Kelola data fakultas &rarr;</span>
    </a>

    <a class="admin-stat-card accent-blue" href="index.php?c=adminprodi">
        <div class="admin-stat-top">
            <span class="admin-stat-num"><?= (int)$jumlahProdi ?></span>
            <span class="admin-stat-badge">Untad</span>
        </div>
        <p class="admin-stat-label">Program Studi</p>
        <span class="admin-stat-hint">Kelola data prodi &rarr;</span>
    </a>

    <a class="admin-stat-card accent-slate" href="index.php?c=adminprofil">
        <div class="admin-stat-top">
            <span class="admin-stat-title">Profil</span>
            <span class="admin-stat-badge badge-muted">Pengaturan</span>
        </div>
        <p class="admin-stat-label">Kelola profil kampus</p>
        <span class="admin-stat-hint">Ubah informasi &amp; foto &rarr;</span>
    </a>
</div>