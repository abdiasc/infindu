<?php
namespace App\Middleware;

class Auth {
    public static function check() {
        return isset($_SESSION['usuario_id']);
    }
    public static function requireLogin()
    {
        if (!isset($_SESSION['usuario_id'])) {
            // Redirigir al login si el usuario no ha iniciado sesión
            header('Location: /login');
            exit;
        }
    }

    public static function requireGuest() {
        if (self::check()) {
            $roles = $_SESSION['usuario_roles'] ?? [];

            if (in_array('administrador', $roles)) {
                header('Location: /admin');
                exit;
            } elseif (in_array('profesor', $roles)) {
                header('Location: /profesor');
                exit;
            } elseif (in_array('estudiante', $roles)) {
                header('Location: /estudiante');
                exit;
            }
        }
    }

    public static function requireRole($rol) {
        if (!self::check() || !in_array($rol, $_SESSION['usuario_roles'])) {
            http_response_code(403);
            echo "Acceso denegado";
            exit;
        }
    }
}
