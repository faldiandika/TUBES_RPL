<h1>Dashboard</h1>
<p>Selamat datang, <?= e($_SESSION['admin_nama']) ?>.</p>

<div class="grid">
    <a class="card" href="index.php?c=adminfakultas">
        <h3><?= (int)$jumlahFakultas ?></h3>
        <p>Fakultas</p>
    </a>
    <a class="card" href="index.php?c=adminprodi">
        <h3><?= (int)$jumlahProdi ?></h3>
        <p>Program Studi</p>
    </a>
    <a class="card" href="index.php?c=adminprofil">
        <h3>Profil</h3>
        <p>Kelola profil kampus</p>
    </a>
</div>