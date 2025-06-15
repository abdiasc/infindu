<?php
namespace App\Models;

use Core\Database;
use PDO;

class Inscripcion
{
    public static function yaInscrito(int $estudianteId, int $cursoId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM estudiante_curso WHERE estudiante_id = :estudianteId AND curso_id = :cursoId");
        $stmt->bindValue(':estudianteId', $estudianteId, PDO::PARAM_INT);
        $stmt->bindValue(':cursoId', $cursoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public static function hayCupo(int $cursoId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT (SELECT COUNT(*) FROM estudiante_curso WHERE curso_id = :cursoId1) AS inscritos,
                   cupo_maximo
            FROM cursos WHERE id = :cursoId2
        ");
        $stmt->bindValue(':cursoId1', $cursoId, PDO::PARAM_INT);
        $stmt->bindValue(':cursoId2', $cursoId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data && ($data['cupo_maximo'] == 0 || $data['inscritos'] < $data['cupo_maximo']);
    }

    public static function inscribir(int $estudianteId, int $cursoId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO estudiante_curso (estudiante_id, curso_id) VALUES (:estudianteId, :cursoId)");
        $stmt->bindValue(':estudianteId', $estudianteId, PDO::PARAM_INT);
        $stmt->bindValue(':cursoId', $cursoId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function obtenerCursosActivos(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT id, nombre, descripcion,duracion,categoria FROM cursos WHERE estado = 'activo'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Para que el profesor vea a los estudiantes de su curso
    public static function estudiantesPorCurso(int $cursoId)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT u.id, u.nombre, u.email, e.carrera, e.semestre, e.avatar
            FROM estudiante_curso ec
            JOIN usuarios u ON ec.estudiante_id = u.id
            LEFT JOIN estudiantes e ON e.usuario_id = u.id
            WHERE ec.curso_id = :cursoId
        ");
        $stmt->bindValue(':cursoId', $cursoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function cursosPorEstudiante(int $estudianteId)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT c.*, pc.profesor_id, p.nombre AS profesor_nombre
            FROM estudiante_curso ec
            JOIN cursos c ON ec.curso_id = c.id
            LEFT JOIN profesor_curso pc ON pc.curso_id = c.id
            LEFT JOIN usuarios p ON pc.profesor_id = p.id
            WHERE ec.estudiante_id = :id
        ");
        $stmt->bindValue(':id', $estudianteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
