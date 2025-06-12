<?php
namespace App\Models;

use Core\Database;
use Exception;

class User {
    public static function registrar($nombre, $email, $password) {
        $db = Database::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $db->beginTransaction();

            // Verificar cuántos usuarios existen
            $countStmt = $db->query("SELECT COUNT(*) as total FROM usuarios");
            $totalUsuarios = $countStmt->fetch()['total'];

            $rolPorDefecto = ($totalUsuarios == 0) ? 'administrador' : 'estudiante';

            $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $email, $hashedPassword]);
            $usuarioId = $db->lastInsertId();

            $rolStmt = $db->prepare("SELECT id FROM roles WHERE nombre = ?");
            $rolStmt->execute([$rolPorDefecto]);
            $rol = $rolStmt->fetch();

            if (!$rol) {
                throw new Exception("Rol '{$rolPorDefecto}' no encontrado.");
            }

            $asignar = $db->prepare("INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (?, ?)");
            $asignar->execute([$usuarioId, $rol['id']]);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return false;
        }
    }

    public static function buscarPorEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function obtenerRoles($userId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT r.nombre FROM roles r 
                              INNER JOIN usuario_rol ur ON r.id = ur.rol_id 
                              WHERE ur.usuario_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function obtenerTodosConRoles() {
        $db = Database::getConnection();

        $stmt = $db->query("
            SELECT 
                u.id, 
                u.nombre, 
                u.email, 
                u.fecha_registro, 
                GROUP_CONCAT(r.nombre SEPARATOR ', ') AS roles
            FROM usuarios u
            LEFT JOIN usuario_rol ur ON u.id = ur.usuario_id
            LEFT JOIN roles r ON ur.rol_id = r.id
            GROUP BY u.id
        ");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nombre, email FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function actualizar($id, $nombre, $email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nombre, $email, $id]);
    }

    public static function eliminar($id) {
        $db = Database::getConnection();

        try {
            $db->beginTransaction();

            $stmtRoles = $db->prepare("DELETE FROM usuario_rol WHERE usuario_id = ?");
            $stmtRoles->execute([$id]);

            $stmtUsuario = $db->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmtUsuario->execute([$id]);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
    public static function crear($nombre, $email, $passwordHash) {
        $db = \Core\Database::getConnection();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $passwordHash]);
        return $db->lastInsertId();
    }


    public static function asignarRol($usuario_id, $rol_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (?, ?)");
        return $stmt->execute([$usuario_id, $rol_id]);
    }

    public static function obtenerProfesores() {
        $db = \Core\Database::getConnection();
        $sql = "SELECT u.id, u.nombre 
                FROM usuarios u
                JOIN usuario_rol ur ON u.id = ur.usuario_id
                JOIN roles r ON ur.rol_id = r.id
                WHERE r.nombre = 'profesor'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
    public static function asignarProfesor($curso_id, $profesor_id) {
        $db = Database::getConnection();

        // Elimina asignaciones anteriores para que solo haya un profesor por curso
        $db->prepare("DELETE FROM profesor_curso WHERE curso_id = ?")->execute([$curso_id]);

        // Inserta la nueva asignación
        $stmt = $db->prepare("INSERT INTO profesor_curso (profesor_id, curso_id) VALUES (?, ?)");
        return $stmt->execute([$profesor_id, $curso_id]);
    }


}
