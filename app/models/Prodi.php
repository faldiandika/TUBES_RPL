<?php
class Prodi {
    public static function search(string $keyword = '', int $fakultasId = 0, string $jenjang = ''): array {
        $sql = "SELECT p.*, p.nama_prodi AS nama, f.nama_fakultas AS fakultas_nama
                FROM prodi p
                JOIN fakultas f ON f.id = p.fakultas_id
                WHERE 1=1";
        $params = [];

        if ($keyword !== '') {
            $sql .= " AND p.nama_prodi LIKE ?";
            $params[] = "%$keyword%";
        }
        if ($fakultasId > 0) {
            $sql .= " AND p.fakultas_id = ?";
            $params[] = $fakultasId;
        }
        if ($jenjang !== '') {
            $sql .= " AND p.jenjang = ?";
            $params[] = $jenjang;
        }
        $sql .= " ORDER BY p.nama_prodi";

        $st = getDB()->prepare($sql);
        $st->execute($params);
        return $st->fetchAll();
    }

    public static function find(int $id): ?array {
        $st = getDB()->prepare(
            "SELECT p.*, p.nama_prodi AS nama, f.nama_fakultas AS fakultas_nama
             FROM prodi p
             JOIN fakultas f ON f.id = p.fakultas_id
             WHERE p.id = ?"
        );
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public static function countByFakultas(int $fakultasId): int {
        $st = getDB()->prepare("SELECT COUNT(*) FROM prodi WHERE fakultas_id = ?");
        $st->execute([$fakultasId]);
        return (int)$st->fetchColumn();
    }

    public static function jenjangList(): array {
        return getDB()->query(
            "SELECT DISTINCT jenjang FROM prodi ORDER BY jenjang"
        )->fetchAll(PDO::FETCH_COLUMN);
    }
}