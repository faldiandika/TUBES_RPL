<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/helpers/functions.php';
require_once __DIR__ . '/app/helpers/upload.php';

$c = $_GET['c'] ?? 'home';
$a = $_GET['a'] ?? 'index';

if (!preg_match('/^[a-z]+$/', $c)) {
    http_response_code(404);
    exit('Halaman tidak ditemukan');
}

$peta = [
    'home'          => 'HomeController',
    'fakultas'      => 'FakultasController',
    'prodi'         => 'ProdiController',
    'admin'         => 'AdminController',
    'adminfakultas' => 'AdminFakultasController',
    'adminprodi'    => 'AdminProdiController',
    'adminprofil'   => 'AdminProfilController',
];

if (!isset($peta[$c])) {
    http_response_code(404);
    exit('Halaman tidak ditemukan');
}

$controllerName = $peta[$c];
$file = __DIR__ . "/app/controllers/$controllerName.php";

if (!file_exists($file)) {
    http_response_code(404);
    exit('Halaman tidak ditemukan');
}

require_once $file;
$controller = new $controllerName();

if (!preg_match('/^[a-zA-Z]+$/', $a) || !method_exists($controller, $a)) {
    http_response_code(404);
    exit('Aksi tidak ditemukan');
}

$controller->$a();