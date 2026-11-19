<div class="admin-page-head">
    <span class="admin-eyebrow">Manajemen Fakultas</span>
    <h1><?= e($judul) ?></h1>
</div>

<form class="form admin-form-card" method="post" action="index.php?c=adminfakultas&a=simpan" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int)$f['id'] ?>">

    <label for="nama">Nama Fakultas</label>
    <input type="text" id="nama" name="nama" value="<?= e($f['nama']) ?>" required autofocus>

    <label for="foto">Logo / Foto Fakultas</label>
    <?php if (!empty($f['foto'])): ?>
        <div class="foto-lama">
            <img class="thumb-besar" src="<?= e(img_url($f['foto'])) ?>" alt="Foto saat ini">
            <small>Foto saat ini. Pilih file baru hanya jika ingin menggantinya.</small>
        </div>
    <?php endif; ?>
    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
    <small>Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>

    <div class="form-aksi">
        <button class="btn btn-primary-pill" type="submit">Simpan</button>
        <a class="admin-cancel-link" href="index.php?c=adminfakultas">Batal</a>
    </div>
</form>