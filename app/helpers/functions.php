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