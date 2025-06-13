<?php
namespace App\Models;

use Core\Database;

class Profesor {
    public static function obtenerPorUsuario($usuario_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM profesores WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch();
    }
    public static function crear($datos) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO profesores (usuario_id, especialidad, titulo_academico, experiencia_anios, fecha_ingreso, avatar, biografia)
            VALUES (?, ?, ?, ?, ?, ?,?)
        ");
        return $stmt->execute([
            $datos['usuario_id'],
            $datos['especialidad'],
            $datos['titulo_academico'] ?? null,
            $datos['experiencia_anios'] ?? null,
            $datos['fecha_ingreso'] ?? null,
            $datos['avatar'],
            $datos['biografia'] ?? null,
        ]);
    }


    public static function obtenerCursosAsignados($usuario_id) {
    $db = Database::getConnection();

    // Consultamos los cursos asignados al profesor usando profesor_curso
    $stmt = $db->prepare("
        SELECT c.* FROM cursos c
        INNER JOIN profesor_curso pc ON c.id = pc.curso_id
        WHERE pc.profesor_id = ?
    ");
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll();
}

    

}