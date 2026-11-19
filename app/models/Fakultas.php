<?php
class Fakultas {
    public static function all(): array {
        return getDB()->query(
            "SELECT id, nama_fakultas AS nama, foto_fakultas AS foto
             FROM fakultas ORDER BY nama_fakultas"
        )->fetchAll();
    }

    public static function find(int $id): ?array {
        $st = getDB()->prepare(
            "SELECT id, nama_fakultas AS nama, foto_fakultas AS foto
             FROM fakultas WHERE id = ?"
        );
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public static function create(string $nama, ?string $foto): int {
        $st = getDB()->prepare(
            "INSERT INTO fakultas (nama_fakultas, foto_fakultas) VALUES (?, ?)"
        );
        $st->execute([$nama, $foto]);
        return (int)getDB()->lastInsertId();
    }

    public static function update(int $id, string $nama, ?string $foto): void {
        $st = getDB()->prepare(
            "UPDATE fakultas SET nama_fakultas = ?, foto_fakultas = ? WHERE id = ?"
        );
        $st->execute([$nama, $foto, $id]);
    }

    public static function delete(int $id): void {
        $st = getDB()->prepare("DELETE FROM fakultas WHERE id = ?");
        $st->execute([$id]);
    }

    /** Daftar foto gedung semua prodi di fakultas ini (untuk dibersihkan saat fakultas dihapus). */
    public static function fotoProdi(int $id): array {
        $st = getDB()->prepare(
            "SELECT foto_gedung FROM prodi WHERE fakultas_id = ? AND foto_gedung IS NOT NULL AND foto_gedung <> ''"
        );
        $st->execute([$id]);
        return $st->fetchAll(PDO::FETCH_COLUMN);
    }
}