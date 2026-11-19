<?php
require_once __DIR__ . '/Controller.php';

abstract class AdminBaseController extends Controller {
    public function __construct() {
        if (empty($_SESSION['admin_id'])) {
            redirect('index.php?c=admin&a=login');
        }
    }

    protected function renderAdmin(string $view, array $data = []): void {
        $this->render("admin/$view", $data, 'admin/layout');
    }
}