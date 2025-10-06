<?php
namespace App\Models;

use App\Database\Database;
use PDO;

class CarModel {

    public static function getAll() {
        $pdo = Database::getInstance();
        $sql = "SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series,
                       c.notes, c.extras, c.packed,
                       d.designer,
                       c.img_url
                FROM hw_cars c
                LEFT JOIN colors col ON c.color_id = col.id
                LEFT JOIN years y ON c.year_id = y.id
                LEFT JOIN series s ON c.series_id = s.id
                LEFT JOIN designers d ON c.designer_id = d.id
                ORDER BY y.year DESC, c.name ASC";
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series,
                                      c.notes, c.extras, c.packed,
                                      d.designer AS designer_name,
                                      c.img_url
                               FROM hw_cars c
                               LEFT JOIN colors col ON c.color_id = col.id
                               LEFT JOIN years y ON c.year_id = y.id
                               LEFT JOIN series s ON c.series_id = s.id
                               LEFT JOIN designers d ON c.designer_id = d.id
                               WHERE c.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function filter(array $filters): array {
        $pdo = \App\Database\Database::getInstance();

        $sql = "SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series,
                    c.notes, c.extras, c.packed,
                    d.designer AS designer_name,
                    c.img_url
                FROM hw_cars c
                LEFT JOIN colors col ON c.color_id = col.id
                LEFT JOIN years y ON c.year_id = y.id
                LEFT JOIN series s ON c.series_id = s.id
                LEFT JOIN designers d ON c.designer_id = d.id
                WHERE 1=1";

        $params = [];

        if (!empty($filters['color_id'])) {
            $sql .= " AND c.color_id = :color_id";
            $params['color_id'] = $filters['color_id'];
        }
        if (!empty($filters['year_id'])) {
            $sql .= " AND c.year_id = :year_id";
            $params['year_id'] = $filters['year_id'];
        }
        if (!empty($filters['designer_id'])) {
            $sql .= " AND c.designer_id = :designer_id";
            $params['designer_id'] = $filters['designer_id'];
        }

        $sql .= " ORDER BY y.year DESC, c.name ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function search($keyword) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series,
                                    c.notes, c.extras, c.packed,
                                    d.designer AS designer_name,
                                    c.img_url
                            FROM hw_cars c
                            LEFT JOIN colors col ON c.color_id = col.id
                            LEFT JOIN years y ON c.year_id = y.id
                            LEFT JOIN series s ON c.series_id = s.id
                            LEFT JOIN designers d ON c.designer_id = d.id
                            WHERE c.name LIKE :kw OR c.toy_code LIKE :kw
                            ORDER BY y.year DESC, c.name ASC");
        $stmt->execute(['kw' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getOrCreateId($table, $column, $value) {
        $pdo = Database::getInstance();

        // Megnézzük, van-e már ilyen érték
        $stmt = $pdo->prepare("SELECT id FROM {$table} WHERE {$column} = :val LIMIT 1");
        $stmt->execute(['val' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['id'];
        }

        // Ha nincs, létrehozzuk
        $stmt = $pdo->prepare("INSERT INTO {$table} ({$column}) VALUES (:val)");
        $stmt->execute(['val' => $value]);
        return $pdo->lastInsertId();
    }



    public static function create(array $data) {
        $pdo = Database::getInstance();

        $colorId    = self::getOrCreateId('colors', 'color', $data['color']);
        $yearId     = self::getOrCreateId('years', 'year', $data['year']);
        $seriesId   = self::getOrCreateId('series', 'series', $data['series']);
        $designerId = self::getOrCreateId('designers', 'designer', $data['designer']);

        $stmt = $pdo->prepare("INSERT INTO hw_cars 
            (name, toy_code, color_id, year_id, series_id, designer_id, notes, extras, packed, img_url)
            VALUES (:name, :toy_code, :color_id, :year_id, :series_id, :designer_id, :notes, :extras, :packed, :img_url)");

        $stmt->execute([
            'name'        => $data['name'],
            'toy_code'    => $data['toy_code'],
            'color_id'    => $colorId,
            'year_id'     => $yearId,
            'series_id'   => $seriesId,
            'designer_id' => $designerId,
            'notes'       => $data['notes'],
            'extras'      => $data['extras'],
            'packed'      => !empty($data['packed']) ? 1 : 0,
            'img_url'     => $data['img_url']
        ]);
    }

    public static function update($id, array $data) {
        $pdo = Database::getInstance();

        // Szín/év/sorozat/tervező ID előállítása (getOrCreateId)
        $colorId    = self::getOrCreateId('colors', 'color', $data['color_id']);
        $yearId     = self::getOrCreateId('years', 'year', $data['year_id']);
        $seriesId   = self::getOrCreateId('series', 'series', $data['series_id']);
        $designerId = self::getOrCreateId('designers', 'designer', $data['designer_id']);

        $stmt = $pdo->prepare("UPDATE hw_cars 
            SET name = :name,
                toy_code = :toy_code,
                color_id = :color_id,
                year_id = :year_id,
                series_id = :series_id,
                designer_id = :designer_id,
                notes = :notes,
                extras = :extras,
                packed = :packed,
                img_url = :img_url
            WHERE id = :id");

        $stmt->execute([
            'id'          => $id,
            'name'        => $data['name'] ?? '',
            'toy_code'    => $data['toy_code'] ?? '',
            'color_id'    => $colorId,
            'year_id'     => $yearId,
            'series_id'   => $seriesId,
            'designer_id' => $designerId,
            'notes'       => $data['notes'] ?? '',
            'extras'      => $data['extras'] ?? '',
            'packed'      => !empty($data['packed']) ? 1 : 0,
            'img_url'     => $data['img_url'] ?? ''
        ]);
    }


    public static function delete($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM hw_cars WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
