<?php
class ProfilKampus {
    public static function get(): array {
        $row = getDB()->query(
            "SELECT nama_kampus AS nama, deskripsi, foto FROM profil_kampus LIMIT 1"
        )->fetch();
        return $row ?: ['nama' => 'Universitas Tadulako', 'deskripsi' => '', 'foto' => null];
    }
}