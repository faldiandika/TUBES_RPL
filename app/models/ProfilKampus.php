<?php
class ProfilKampus {
    public static function get(): array {
        $row = getDB()->query(
            "SELECT id, nama_kampus AS nama, deskripsi, foto FROM profil_kampus LIMIT 1"
        )->fetch();
        return $row ?: ['id' => 0, 'nama' => 'Universitas Tadulako', 'deskripsi' => '', 'foto' => null];
    }

    /** Ubah profil; kalau tabel masih kosong, buat baris pertamanya. */
    public static function save(string $nama, string $deskripsi, ?string $foto): void {
        $ada = getDB()->query("SELECT id FROM profil_kampus LIMIT 1")->fetchColumn();
        if ($ada) {
            $st = getDB()->prepare(
                "UPDATE profil_kampus SET nama_kampus = ?, deskripsi = ?, foto = ? WHERE id = ?"
            );
            $st->execute([$nama, $deskripsi, $foto, $ada]);
        } else {
            $st = getDB()->prepare(
                "INSERT INTO profil_kampus (nama_kampus, deskripsi, foto) VALUES (?, ?, ?)"
            );
            $st->execute([$nama, $deskripsi, $foto]);
        }
    }
}