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
}