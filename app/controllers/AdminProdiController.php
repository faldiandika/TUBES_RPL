<?php
require_once __DIR__ . '/AdminBaseController.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class AdminProdiController extends AdminBaseController {
    private const JENJANG = ['D3', 'S1', 'S2', 'S3'];

    // Daftar prodi
    public function index(): void {
        $this->renderAdmin('prodi/index', ['prodi' => Prodi::search()]);
    }

    // Form tambah
    public function tambah(): void {
        $this->renderAdmin('prodi/form', [
            'judul'    => 'Tambah Program Studi',
            'p'        => [
                'id' => 0, 'fakultas_id' => 0, 'nama_prodi' => '', 'jenjang' => 'S1',
                'akreditasi' => '', 'gelar_lulusan' => '', 'ukt' => '', 'deskripsi' => '',
                'visi_misi' => '', 'kurikulum' => '', 'prospek_kerja' => '',
                'jalur_penerimaan' => '', 'foto_gedung' => '', 'maps_embed_url' => '',
            ],
            'fakultas' => Fakultas::all(),
            'jenjang'  => self::JENJANG,
        ]);
    }

    // Form ubah
    public function ubah(): void {
        $p = Prodi::find((int)($_GET['id'] ?? 0));
        if (!$p) {
            flash('Program studi tidak ditemukan.', 'err');
            redirect('index.php?c=adminprodi');
        }
        $this->renderAdmin('prodi/form', [
            'judul'    => 'Ubah Program Studi',
            'p'        => $p,
            'fakultas' => Fakultas::all(),
            'jenjang'  => self::JENJANG,
        ]);
    }

    // Proses simpan (tambah atau ubah)
    public function simpan(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
            http_response_code(400);
            exit('Permintaan tidak valid');
        }

        $id   = (int)($_POST['id'] ?? 0);
        $lama = $id > 0 ? Prodi::find($id) : null;
        $balik = $id > 0 ? "index.php?c=adminprodi&a=ubah&id=$id" : 'index.php?c=adminprodi&a=tambah';

        $d = [
            'fakultas_id'      => (int)($_POST['fakultas_id'] ?? 0),
            'nama_prodi'       => trim($_POST['nama_prodi'] ?? ''),
            'jenjang'          => $_POST['jenjang'] ?? '',
            'akreditasi'       => trim($_POST['akreditasi'] ?? ''),
            'gelar_lulusan'    => trim($_POST['gelar_lulusan'] ?? ''),
            'ukt'              => trim($_POST['ukt'] ?? ''),
            'deskripsi'        => trim($_POST['deskripsi'] ?? ''),
            'visi_misi'        => trim($_POST['visi_misi'] ?? ''),
            'kurikulum'        => trim($_POST['kurikulum'] ?? ''),
            'prospek_kerja'    => trim($_POST['prospek_kerja'] ?? ''),
            'jalur_penerimaan' => trim($_POST['jalur_penerimaan'] ?? ''),
            'maps_embed_url'   => trim($_POST['maps_embed_url'] ?? ''),
        ];

        // Validasi
        if ($d['nama_prodi'] === '') {
            flash('Nama program studi wajib diisi.', 'err');
            redirect($balik);
        }
        if (!Fakultas::find($d['fakultas_id'])) {
            flash('Pilih fakultas terlebih dahulu.', 'err');
            redirect($balik);
        }
        if (!in_array($d['jenjang'], self::JENJANG, true)) {
            flash('Jenjang tidak valid.', 'err');
            redirect($balik);
        }
        if ($d['maps_embed_url'] !== '' && maps_url($d['maps_embed_url']) === '') {
            flash('Link peta harus berupa URL embed Google Maps (diawali https://www.google.com/maps/embed).', 'err');
            redirect($balik);
        }

        // Foto gedung
        $foto = simpan_foto('foto_gedung', 'PRODI');
        if ($foto !== null && str_starts_with($foto, 'ERROR:')) {
            flash(substr($foto, 6), 'err');
            redirect($balik);
        }

        if ($lama) {
            if ($foto !== null) {
                hapus_foto($lama['foto_gedung']);
                $d['foto_gedung'] = $foto;
            } else {
                $d['foto_gedung'] = $lama['foto_gedung'];
            }
            Prodi::update($id, $d);
            flash('Program studi berhasil diubah.');
        } else {
            $d['foto_gedung'] = $foto;
            Prodi::create($d);
            flash('Program studi berhasil ditambahkan.');
        }
        redirect('index.php?c=adminprodi');
    }

    // Proses hapus
    public function hapus(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
            http_response_code(400);
            exit('Permintaan tidak valid');
        }

        $p = Prodi::find((int)($_POST['id'] ?? 0));
        if (!$p) {
            flash('Program studi tidak ditemukan.', 'err');
            redirect('index.php?c=adminprodi');
        }

        Prodi::delete((int)$p['id']);
        hapus_foto($p['foto_gedung']);

        flash('Program studi berhasil dihapus.');
        redirect('index.php?c=adminprodi');
    }
}