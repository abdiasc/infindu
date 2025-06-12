<?php
namespace App\Models;

use Core\Database;

class Estudiante {
    public static function obtenerPorUsuario($usuario_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM estudiantes WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch();
    }
    public static function crear($datos) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO estudiantes (usuario_id, carrera, semestre, matricula, fecha_nacimiento, avatar)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $datos['usuario_id'],
            $datos['carrera'],
            $datos['semestre'] ?? null,
            $datos['matricula'] ?? null,
            $datos['fecha_nacimiento'] ?? null,
            $datos['avatar'],
        ]);
    }
}