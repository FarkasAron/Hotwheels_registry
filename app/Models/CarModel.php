<?php
namespace App\Models;

use App\Database\Database;
use App\Interfaces\CarRepositoryInterface;
use PDO;

class CarModel implements CarRepositoryInterface {

    public static function getAll() {
        $pdo = Database::getInstance();
        $sql = "SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series, c.notes, c.extras, c.packed, 
                       d.designer, c.img_url, c.color_id, c.year_id, c.series_id, c.designer_id
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
        $stmt = $pdo->prepare("SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series, c.notes, c.extras, c.packed, 
                                      d.designer, c.img_url, c.color_id, c.year_id, c.series_id, c.designer_id
                               FROM hw_cars c
                               LEFT JOIN colors col ON c.color_id = col.id
                               LEFT JOIN years y ON c.year_id = y.id
                               LEFT JOIN series s ON c.series_id = s.id
                               LEFT JOIN designers d ON c.designer_id = d.id
                               WHERE c.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function search($keyword) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id, c.name, c.toy_code, col.color, y.year, s.series, c.notes, c.extras, c.packed, 
                                      d.designer, c.img_url, c.color_id, c.year_id, c.series_id, c.designer_id
                               FROM hw_cars c
                               LEFT JOIN colors col ON c.color_id = col.id
                               LEFT JOIN years y ON c.year_id = y.id
                               LEFT JOIN series s ON c.series_id = s.id
                               LEFT JOIN designers d ON c.designer_id = d.id
                               WHERE c.name LIKE :kw OR c.toy_code LIKE :kw");
        $stmt->execute(['kw' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO hw_cars 
            (name, toy_code, color_id, year_id, series_id, notes, extras, packed, designer_id, img_url)
            VALUES (:name, :toy_code, :color_id, :year_id, :series_id, :notes, :extras, :packed, :designer_id, :img_url)");
        return $stmt->execute($data);
    }

    public static function update($id, array $data) {
        $pdo = Database::getInstance();
        $data['id'] = $id;
        $stmt = $pdo->prepare("UPDATE hw_cars SET 
            name=:name, toy_code=:toy_code, color_id=:color_id, year_id=:year_id, series_id=:series_id,
            notes=:notes, extras=:extras, packed=:packed, designer_id=:designer_id, img_url=:img_url
            WHERE id=:id");
        return $stmt->execute($data);
    }

    public static function delete($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM hw_cars WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
