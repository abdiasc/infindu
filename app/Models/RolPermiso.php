<?php
namespace App\Models;
use PDO;
use Core\Database;

class RolPermiso {
    public static function asignar($rol_id, $permiso_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO rol_permiso (rol_id, permiso_id) VALUES (?, ?)");
        return $stmt->execute([$rol_id, $permiso_id]);
    }

    public static function eliminar($rol_id, $permiso_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM rol_permiso WHERE rol_id = ? AND permiso_id = ?");
        return $stmt->execute([$rol_id, $permiso_id]);
    }

    public static function obtenerPorRol($rol_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT p.* FROM permisos p
                              JOIN rol_permiso rp ON p.id = rp.permiso_id
                              WHERE rp.rol_id = ?");
        $stmt->execute([$rol_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
