<?php
namespace App\Models;

use Core\Database;  // IMPORTANTE: importar la clase Core\Database

class Curso {
    public static function obtenerTodos() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT cursos.*, usuarios.nombre AS creador
            FROM cursos
            JOIN usuarios ON cursos.creado_por = usuarios.id
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function crear($datos) {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO cursos (
                nombre, descripcion, creado_por, categoria, nivel,
                duracion, imagen_portada, estado, fecha_inicio,
                fecha_fin, cupo_maximo, visibilidad
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $datos['nombre'],
            $datos['descripcion'],
            $datos['creado_por'],
            $datos['categoria'],
            $datos['nivel'],
            $datos['duracion'],
            $datos['imagen_portada'],
            $datos['estado'],
            $datos['fecha_inicio'],
            $datos['fecha_fin'],
            $datos['cupo_maximo'],
            $datos['visibilidad']
        ]);
    }

    public static function obtenerPorId($id) {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            SELECT cursos.*, usuarios.nombre AS creador
            FROM cursos
            LEFT JOIN usuarios ON cursos.creado_por = usuarios.id
            WHERE cursos.id = ?
        ");

        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function obtenerPorIdCursos($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM cursos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function obtenerProfesorAsignado($curso_id) {
        $db = Database::getConnection();
        $sql = "SELECT u.id AS usuario_id, u.nombre, u.email
            FROM profesor_curso pc
            JOIN usuarios u ON pc.profesor_id = u.id
            WHERE pc.curso_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$curso_id]);
        return $stmt->fetch(); // solo debe haber uno por curso
    }
    public static function estaAsignadoACurso($profesorId, $cursoId) {
        $db = \Core\Database::getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM profesor_curso WHERE profesor_id = ? AND curso_id = ?");
        $stmt->execute([$profesorId, $cursoId]);
        return $stmt->fetchColumn() > 0;
    }


    

    public static function asignarProfesor($curso_id, $profesor_id) {
        $db = Database::getConnection();
        
        // Eliminar asignaciones previas (asumiendo 1 profesor por curso)
        $db->prepare("DELETE FROM profesor_curso WHERE curso_id = ?")->execute([$curso_id]);

        // Insertar nuevo
        $sql = "INSERT INTO profesor_curso (curso_id, profesor_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$curso_id, $profesor_id]);
    }

    public static function obtenerTodosConProfesor() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT cursos.*, 
                usuarios.nombre AS creador,
                prof.nombre AS profesor_nombre
            FROM cursos
            JOIN usuarios ON cursos.creado_por = usuarios.id
            LEFT JOIN profesor_curso pc ON cursos.id = pc.curso_id
            LEFT JOIN usuarios prof ON pc.profesor_id = prof.id
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function estaInscrito($usuario_id, $curso_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM estudiante_curso WHERE estudiante_id = ? AND curso_id = ?");
        $stmt->execute([$usuario_id, $curso_id]);
        return $stmt->fetch() !== false;
    }

}