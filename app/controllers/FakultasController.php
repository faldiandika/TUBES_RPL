<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class FakultasController extends Controller {
    public function index(): void {
        $daftar = Fakultas::all();
        foreach ($daftar as &$f) {
            $f['jumlah_prodi'] = Prodi::countByFakultas($f['id']);
        }
        unset($f);
        $this->render('fakultas/index', ['fakultas' => $daftar]);
    }
}