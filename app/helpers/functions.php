<?php
function e($s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function img_url(?string $path): string {
    if (!$path) return '';
    $segments = array_map('rawurlencode', explode('/', $path));
    return 'public/images/' . implode('/', $segments);
}

function maps_url(?string $url): string {
    return str_starts_with((string)$url, 'https://www.google.com/maps/embed') ? $url : '';
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

/** Token pengaman form admin. */
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function csrf_valid(): bool {
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

function flash(?string $pesan = null, string $tipe = 'ok') {
    if ($pesan !== null) {
        $_SESSION['flash'] = ['pesan' => $pesan, 'tipe' => $tipe];
        return null;
    }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}