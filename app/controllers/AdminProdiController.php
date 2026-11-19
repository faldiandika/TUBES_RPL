<?php
require_once __DIR__ . '/AdminBaseController.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class AdminProdiController extends AdminBaseController {
    public function index(): void {
        exit('Daftar program studi menyusul.');
    }
}