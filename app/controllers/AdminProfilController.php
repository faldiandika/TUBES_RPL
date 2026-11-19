<?php
require_once __DIR__ . '/AdminBaseController.php';
require_once __DIR__ . '/../models/ProfilKampus.php';

class AdminProfilController extends AdminBaseController {

    // Form edit profil
    public function index(): void {
        $this->renderAdmin('profil/form', ['profil' => ProfilKampus::get()]);
    }

    // Proses simpan
    public function simpan(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
            http_response_code(400);
            exit('Permintaan tidak valid');
        }

        $lama      = ProfilKampus::get();
        $nama      = trim($_POST['nama'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');

        if ($nama === '') {
            flash('Nama kampus wajib diisi.', 'err');
            redirect('index.php?c=adminprofil');
        }

        $foto = simpan_foto('foto', 'Untad');
        if ($foto !== null && str_starts_with($foto, 'ERROR:')) {
            flash(substr($foto, 6), 'err');
            redirect('index.php?c=adminprofil');
        }

        if ($foto !== null) {
            hapus_foto($lama['foto']);
        } else {
            $foto = $lama['foto'];
        }

        ProfilKampus::save($nama, $deskripsi, $foto);
        flash('Profil kampus berhasil disimpan.');
        redirect('index.php?c=adminprofil');
    }
}