<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Fakultas.php';
require_once __DIR__ . '/../models/Prodi.php';

class AdminController extends Controller {
    public function index(): void {
        redirect(empty($_SESSION['admin_id'])
            ? 'index.php?c=admin&a=login'
            : 'index.php?c=admin&a=dashboard');
    }

    public function login(): void {
        if (!empty($_SESSION['admin_id'])) {
            redirect('index.php?c=admin&a=dashboard');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_valid()) {
                $error = 'Sesi tidak valid, coba lagi.';
            } else {
                $admin = Admin::attempt(trim($_POST['username'] ?? ''), $_POST['password'] ?? '');
                if ($admin) {
                    session_regenerate_id(true);
                    $_SESSION['admin_id']   = $admin['id'];
                    $_SESSION['admin_nama'] = $admin['nama_admin'] ?: $admin['username'];
                    redirect('index.php?c=admin&a=dashboard');
                }
                $error = 'Username atau password salah.';
            }
        }

        require __DIR__ . '/../views/admin/login.php';
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        redirect('index.php?c=admin&a=login');
    }

    public function dashboard(): void {
        if (empty($_SESSION['admin_id'])) {
            redirect('index.php?c=admin&a=login');
        }
        $this->render('admin/dashboard', [
            'jumlahFakultas' => count(Fakultas::all()),
            'jumlahProdi'    => count(Prodi::search()),
        ], 'admin/layout');
    }
}