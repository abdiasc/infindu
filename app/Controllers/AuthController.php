<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Models\Rol;
use App\Middleware\Auth;


class AuthController extends Controller {
    
    public function mostrarLogin() {
        Auth::requireGuest(); // Redirige si ya está logueado
        $this->view('auth/login');
    }

    public function registroForm() {
        Auth::requireGuest();
        $this->view('auth/registro');
    }

   


    public function login() {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $usuario = User::buscarPorEmail($email);

        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $roles = User::obtenerRoles($usuario['id']);
            $_SESSION['usuario_roles'] = $roles;

            // Redirección según rol
            if (in_array('administrador', $roles)) {
                header('Location: /admin');
            } elseif (in_array('profesor', $roles)) {
                header('Location: /profesor');
            } elseif (in_array('estudiante', $roles)) {
                header('Location: /estudiante');
            } else {
                $this->view('auth/login', ['error' => 'Rol desconocido. Contacta con soporte.']);
            }
        } else {
            $this->view('auth/login', ['error' => 'Credenciales incorrectas.']);
        }
    }

    public function registrar() {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmar = $_POST['confirmar'];

        if ($nombre === '' || $email === '' || $password === '' || $confirmar === '') {
            $this->view('auth/registro', ['error' => 'Todos los campos son obligatorios.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('auth/registro', ['error' => 'Email no válido.']);
            return;
        }

        if ($password !== $confirmar) {
            $this->view('auth/registro', ['error' => 'Las contraseñas no coinciden.']);
            return;
        }

        if (User::buscarPorEmail($email)) {
            $this->view('auth/registro', ['error' => 'Ya existe un usuario con ese email.']);
            return;
        }

        $exito = User::registrar($nombre, $email, $password);

        if ($exito) {
            header('Location: /login');
        } else {
            $this->view('auth/registro', ['error' => 'Error al registrar el usuario.']);
        }
    }


    public function registroAsignarRol() {
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';
        $rol_id = $_POST['rol'] ?? null;

        // Validaciones...
        if ($password !== $confirmar) {
            $error = "Las contraseñas no coinciden";
            $roles = Rol::obtenerTodos(); // para recargar el form
            return $this->view('auth/registro', compact('error', 'roles'));
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $usuarioId = User::crear($nombre, $email, $passwordHash);

        if ($usuarioId && $rol_id) {
            User::asignarRol($usuarioId, $rol_id);
        }

        // Redirigir o mostrar mensaje de éxito
        header('Location: /admin/users');
        exit;
    }



    

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
