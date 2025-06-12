<?php

namespace App\Models;
use PDO;
use Core\Database;

class Permiso {
    public static function obtenerTodos() {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM permisos")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM permisos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre, $descripcion) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO permisos (nombre, descripcion) VALUES (?, ?)");
        return $stmt->execute([$nombre, $descripcion]);
    }

    public static function actualizar($id, $nombre, $descripcion) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE permisos SET nombre = ?, descripcion = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $id]);
    }

    public static function eliminar($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM permisos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
