<?php
namespace App\Models;

use Core\Database;

class Leccion {

    public static function todasPorCurso($curso_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lecciones WHERE curso_id = ? ORDER BY orden ASC");
        $stmt->execute([$curso_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function crear($datos) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO lecciones (curso_id, titulo, contenido, url_video, orden)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $datos['curso_id'],
            $datos['titulo'],
            $datos['contenido'],
            $datos['url_video'],
            $datos['orden']
        ]);
    }

    public static function obtener($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lecciones WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

   



    public static function actualizar($id, $datos) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            UPDATE lecciones
            SET titulo = ?, contenido = ?, url_video = ?, orden = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $datos['titulo'],
            $datos['contenido'],
            $datos['url_video'],
            $datos['orden'],
            $id
        ]);
    }

    public static function eliminar($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM lecciones WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function obtenerPorCurso($curso_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lecciones WHERE curso_id = ? ORDER BY orden ASC");
        $stmt->execute([$curso_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function obtenerAnterior($id, $cursoId)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lecciones WHERE curso_id = :cursoId AND id < :id ORDER BY id DESC LIMIT 1");
        $stmt->execute([':cursoId' => $cursoId, ':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function obtenerSiguiente($id, $cursoId)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lecciones WHERE curso_id = :cursoId AND id > :id ORDER BY id ASC LIMIT 1");
        $stmt->execute([':cursoId' => $cursoId, ':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


}
?>
