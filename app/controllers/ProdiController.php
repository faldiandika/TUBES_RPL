<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class ProdiController extends Controller {
    public function index(): void {
        $q           = trim($_GET['q'] ?? '');
        $fakultasId  = (int)($_GET['fakultas'] ?? 0);
        $jenjangList = Prodi::jenjangList();
        $jenjang     = $_GET['jenjang'] ?? '';
        if (!in_array($jenjang, $jenjangList, true)) $jenjang = '';

        $this->render('prodi/index', [
            'prodi'       => Prodi::search($q, $fakultasId, $jenjang),
            'fakultas'    => Fakultas::all(),
            'jenjangList' => $jenjangList,
            'q'           => $q,
            'fakultasId'  => $fakultasId,
            'jenjang'     => $jenjang,
        ]);
    }

    public function detail(): void {
        $prodi = Prodi::find((int)($_GET['id'] ?? 0));
        if (!$prodi) {
            http_response_code(404);
            exit('Program studi tidak ditemukan');
        }
        $this->render('prodi/detail', ['prodi' => $prodi]);
    }
}