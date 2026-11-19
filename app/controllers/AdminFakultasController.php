<?php
require_once __DIR__ . '/AdminBaseController.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class AdminFakultasController extends AdminBaseController {

    // Daftar fakultas
    public function index(): void {
        $daftar = Fakultas::all();
        foreach ($daftar as &$f) {
            $f['jumlah_prodi'] = Prodi::countByFakultas((int)$f['id']);
        }
        unset($f);
        $this->renderAdmin('fakultas/index', ['fakultas' => $daftar]);
    }

    // Form tambah
    public function tambah(): void {
        $this->renderAdmin('fakultas/form', [
            'judul' => 'Tambah Fakultas',
            'f'     => ['id' => 0, 'nama' => '', 'foto' => ''],
        ]);
    }

    // Form ubah
    public function ubah(): void {
        $f = Fakultas::find((int)($_GET['id'] ?? 0));
        if (!$f) {
            flash('Fakultas tidak ditemukan.', 'err');
            redirect('index.php?c=adminfakultas');
        }
        $this->renderAdmin('fakultas/form', ['judul' => 'Ubah Fakultas', 'f' => $f]);
    }

    // Proses simpan (tambah atau ubah)
    public function simpan(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
            http_response_code(400);
            exit('Permintaan tidak valid');
        }

        $id   = (int)($_POST['id'] ?? 0);
        $nama = trim($_POST['nama'] ?? '');
        $lama = $id > 0 ? Fakultas::find($id) : null;

        if ($nama === '') {
            flash('Nama fakultas wajib diisi.', 'err');
            redirect($id > 0 ? "index.php?c=adminfakultas&a=ubah&id=$id" : 'index.php?c=adminfakultas&a=tambah');
        }

        $foto = simpan_foto('foto', 'FAKULTAS');
        if ($foto !== null && str_starts_with($foto, 'ERROR:')) {
            flash(substr($foto, 6), 'err');
            redirect($id > 0 ? "index.php?c=adminfakultas&a=ubah&id=$id" : 'index.php?c=adminfakultas&a=tambah');
        }

        if ($id > 0 && $lama) {
            if ($foto !== null) {
                hapus_foto($lama['foto']);   // ganti foto: hapus yang lama
            } else {
                $foto = $lama['foto'];       // tidak upload: pakai foto lama
            }
            Fakultas::update($id, $nama, $foto);
            flash('Fakultas berhasil diubah.');
        } else {
            Fakultas::create($nama, $foto);
            flash('Fakultas berhasil ditambahkan.');
        }
        redirect('index.php?c=adminfakultas');
    }

    // Proses hapus (fakultas + semua prodinya)
    public function hapus(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
            http_response_code(400);
            exit('Permintaan tidak valid');
        }

        $id = (int)($_POST['id'] ?? 0);
        $f  = Fakultas::find($id);
        if (!$f) {
            flash('Fakultas tidak ditemukan.', 'err');
            redirect('index.php?c=adminfakultas');
        }

        // Ambil daftar foto dulu, karena data prodi hilang setelah fakultas dihapus
        $fotoProdi = Fakultas::fotoProdi($id);

        Fakultas::delete($id);

        hapus_foto($f['foto']);
        foreach ($fotoProdi as $p) {
            hapus_foto($p);
        }

        flash('Fakultas dan seluruh program studinya berhasil dihapus.');
        redirect('index.php?c=adminfakultas');
    }
}