<h1><?= e($judul) ?></h1>

<form class="form" method="post" action="index.php?c=adminprodi&a=simpan" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">

    <label for="nama_prodi">Nama Program Studi</label>
    <input type="text" id="nama_prodi" name="nama_prodi" value="<?= e($p['nama_prodi']) ?>" required autofocus>

    <label for="fakultas_id">Fakultas</label>
    <select id="fakultas_id" name="fakultas_id" required>
        <option value="">-- Pilih fakultas --</option>
        <?php foreach ($fakultas as $fk): ?>
            <option value="<?= (int)$fk['id'] ?>" <?= (int)$fk['id'] === (int)$p['fakultas_id'] ? 'selected' : '' ?>>
                <?= e($fk['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="jenjang">Jenjang</label>
    <select id="jenjang" name="jenjang" required>
        <?php foreach ($jenjang as $j): ?>
            <option value="<?= e($j) ?>" <?= $j === $p['jenjang'] ? 'selected' : '' ?>><?= e($j) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="akreditasi">Akreditasi</label>
    <input type="text" id="akreditasi" name="akreditasi" value="<?= e($p['akreditasi']) ?>" placeholder="Contoh: Baik Sekali">

    <label for="gelar_lulusan">Gelar Lulusan</label>
    <input type="text" id="gelar_lulusan" name="gelar_lulusan" value="<?= e($p['gelar_lulusan']) ?>" placeholder="Contoh: S.Kom.">

    <label for="ukt">UKT</label>
    <input type="text" id="ukt" name="ukt" value="<?= e($p['ukt']) ?>" placeholder="Contoh: Rp 4.000.000">

    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="5"><?= e($p['deskripsi']) ?></textarea>

    <label for="visi_misi">Visi &amp; Misi</label>
    <textarea id="visi_misi" name="visi_misi" rows="5"><?= e($p['visi_misi']) ?></textarea>

    <label for="kurikulum">Kurikulum</label>
    <textarea id="kurikulum" name="kurikulum" rows="5"><?= e($p['kurikulum']) ?></textarea>

    <label for="prospek_kerja">Prospek Kerja</label>
    <textarea id="prospek_kerja" name="prospek_kerja" rows="4"><?= e($p['prospek_kerja']) ?></textarea>

    <label for="jalur_penerimaan">Jalur Penerimaan</label>
    <textarea id="jalur_penerimaan" name="jalur_penerimaan" rows="3"><?= e($p['jalur_penerimaan']) ?></textarea>

    <label for="foto_gedung">Foto Gedung</label>
    <?php if (!empty($p['foto_gedung'])): ?>
        <div class="foto-lama">
            <img class="thumb-besar" src="<?= e(img_url($p['foto_gedung'])) ?>" alt="Foto saat ini">
            <small>Foto saat ini. Pilih file baru hanya jika ingin menggantinya.</small>
        </div>
    <?php endif; ?>
    <input type="file" id="foto_gedung" name="foto_gedung" accept="image/jpeg,image/png,image/webp">
    <small>Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>

    <label for="maps_embed_url">Link Peta (Embed Google Maps)</label>
    <textarea id="maps_embed_url" name="maps_embed_url" rows="3"
              placeholder="https://www.google.com/maps/embed?pb=..."><?= e($p['maps_embed_url']) ?></textarea>
    <small>Di Google Maps: Bagikan &rarr; Sematkan peta &rarr; salin hanya isi <code>src="..."</code>.</small>

    <div class="form-aksi">
        <button class="btn" type="submit">Simpan</button>
        <a href="index.php?c=adminprodi">Batal</a>
    </div>
</form>