<h1>Profil Kampus</h1>

<form class="form" method="post" action="index.php?c=adminprofil&a=simpan" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label for="nama">Nama Kampus</label>
    <input type="text" id="nama" name="nama" value="<?= e($profil['nama']) ?>" required autofocus>

    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="8"><?= e($profil['deskripsi']) ?></textarea>

    <label for="foto">Logo / Foto Kampus</label>
    <?php if (!empty($profil['foto'])): ?>
        <div class="foto-lama">
            <img class="thumb-besar" src="<?= e(img_url($profil['foto'])) ?>" alt="Foto saat ini">
            <small>Foto saat ini. Pilih file baru hanya jika ingin menggantinya.</small>
        </div>
    <?php endif; ?>
    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
    <small>Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>

    <div class="form-aksi">
        <button class="btn" type="submit">Simpan</button>
        <a href="index.php?c=admin&a=dashboard">Kembali</a>
    </div>
</form>