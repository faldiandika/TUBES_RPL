<?php
abstract class Controller {
    protected function render(string $view, array $data = [], string $layout = 'layout'): void {
        extract($data);
        require __DIR__ . "/../views/$layout/header.php";
        require __DIR__ . "/../views/$view.php";
        require __DIR__ . "/../views/$layout/footer.php";
    }
}