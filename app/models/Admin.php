<?php
class Admin {
    public static function attempt(string $username, string $password): ?array {
        $st = getDB()->prepare(
            "SELECT id, username, password, nama_admin FROM admin WHERE username = ?"
        );
        $st->execute([$username]);
        $admin = $st->fetch();

        if ($admin && hash_equals($admin['password'], hash('sha256', $password))) {
            return $admin;
        }
        return null;
    }
}