<?php
namespace App\Models;
use Core\Database;
use Exception;
use PDO;

class Rol
{
    public static function obtenerTodos()
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM roles ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId(int $id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crear(string $nombre)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO roles (nombre) VALUES (:nombre)");
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function actualizar(int $id, string $nombre)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE roles SET nombre = :nombre WHERE id = :id");
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function eliminar(int $id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM roles WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
