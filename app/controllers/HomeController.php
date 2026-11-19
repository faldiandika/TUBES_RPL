<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';
require_once __DIR__ . '/../models/ProfilKampus.php';

class HomeController extends Controller {
    public function index(): void {
        $this->render('home/index', [
            'profil'   => ProfilKampus::get(),
            'fakultas' => Fakultas::all(),
            'prodi'    => array_slice(Prodi::search(), 0, 3),
        ]);
    }
}