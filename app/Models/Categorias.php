<?php
namespace App\Models;
use Core\Database;
use PDO;

class Categorias
{
    public static function obtenerTodos()
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM categorias ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId(int $id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crear(string $nombre, string $color = null, string $descripcion = null)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO categorias (nombre, color, descripcion) VALUES (:nombre, :color, :descripcion)");
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':color', $color, PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function actualizar(int $id, string $nombre, string $color = null, string $descripcion = null)
    {
        $db = Database::getConnection();
        
        // Construir dinámicamente la consulta SQL
        $campos = ['nombre = :nombre'];
        $parametros = [
            ':nombre' => $nombre,
            ':id' => $id
        ];

        if ($color !== null) {
            $campos[] = 'color = :color';
            $parametros[':color'] = $color;
        }

        if ($descripcion !== null) {
            $campos[] = 'descripcion = :descripcion';
            $parametros[':descripcion'] = $descripcion;
        }

        $sql = "UPDATE categorias SET " . implode(', ', $campos) . " WHERE id = :id";
        $stmt = $db->prepare($sql);

        // Asignar los valores
        foreach ($parametros as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    public static function eliminar(int $id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM categorias WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}


?>