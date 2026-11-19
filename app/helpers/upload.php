<?php
/**
 * Simpan foto upload ke public/images/<subfolder>/.
 * Return path relatif (contoh: FAKULTAS/abc123.png), atau null kalau tidak ada file.
 * Kalau file tidak valid, return string 'ERROR:pesan'.
 */
function simpan_foto(string $inputName, string $subfolder): ?string {
    if (empty($_FILES[$inputName]) || $_FILES[$inputName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $f = $_FILES[$inputName];
    if ($f['error'] !== UPLOAD_ERR_OK) {
        return 'ERROR:Upload gagal, coba lagi.';
    }
    if ($f['size'] > 2 * 1024 * 1024) {
        return 'ERROR:Ukuran foto maksimal 2 MB.';
    }

    // Cek tipe dari isi file, bukan dari ekstensi
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $boleh = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($boleh[$mime])) {
        return 'ERROR:Foto harus berformat JPG, PNG, atau WEBP.';
    }

    $folder = __DIR__ . '/../../public/images/' . $subfolder;
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $namaFile = bin2hex(random_bytes(8)) . '.' . $boleh[$mime];
    if (!move_uploaded_file($f['tmp_name'], "$folder/$namaFile")) {
        return 'ERROR:Gagal menyimpan file.';
    }

    return "$subfolder/$namaFile";
}

/** Hapus file foto lama berdasarkan path relatif di database. */
function hapus_foto(?string $path): void {
    if (!$path) return;
    $file = realpath(__DIR__ . '/../../public/images/' . $path);
    $dasar = realpath(__DIR__ . '/../../public/images');
    if ($file && $dasar && str_starts_with($file, $dasar) && is_file($file)) {
        unlink($file);
    }
}