<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Curso;
use App\Models\User;
use App\Models\Rol;

class AdminController extends Controller {
    public function dashboard() {
        Auth::requireRole('administrador');
        $cursos = Curso::obtenerTodos();
        $this->view('admin/dashboard', [
            'title' => 'Panel de Administración',
            'cursos' => $cursos
        ]);
    }

    public function usuarios() {
        Auth::requireRole('administrador');

        $usuarios = User::obtenerTodosConRoles(); // Método en el modelo
        $this->view('admin/usuarios', [
            'title' => 'Administración de Usuarios',
            'usuarios' => $usuarios]);
    }

    public function crearUsuario() {
        Auth::requireRole('administrador');
        $roles = Rol::obtenerTodos(); // Obtener todos los roles disponibles
        $this->view('admin/crear_usuario', [
            'title' => 'Crear Usuario',
            'error' => null,
            'roles' => $roles
        ]);
    }


    public function guardarUsuario() {
        Auth::requireRole('administrador');

        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmar = $_POST['confirmar'];

        if ($nombre === '' || $email === '' || $password === '' || $confirmar === '') {
            $this->view('admin/crear_usuario', ['error' => 'Todos los campos son obligatorios.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('admin/crear_usuario', ['error' => 'Email inválido.']);
            return;
        }

        if ($password !== $confirmar) {
            $this->view('admin/crear_usuario', ['error' => 'Las contraseñas no coinciden.']);
            return;
        }

        if (User::buscarPorEmail($email)) {
            $this->view('admin/crear_usuario', ['error' => 'Ya existe un usuario con ese email.']);
            return;
        }

        $exito = User::registrar($nombre, $email, $password);

        if ($exito) {
            header('Location: /admin/usuarios');
        } else {
            $this->view('admin/crear_usuario', ['error' => 'Error al crear el usuario.']);
        }
    }

    public function editarUsuario($id) {
        Auth::requireRole('administrador');
        $usuario = User::buscarPorId($id);
        if (!$usuario) {
            header('Location: /admin/usuarios');
            exit;
        }

        $roles = Rol::obtenerTodos();
        $rolesUsuario = User::obtenerRoles($id);
        $this->view('admin/editar_usuario', compact('usuario', 'roles', 'rolesUsuario'));
    }

    public function actualizarUsuario() {
        Auth::requireRole('administrador');

        $id = $_POST['id'];
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $roles = $_POST['roles'] ?? [];

        // Validaciones básicas
        if ($nombre === '' || $email === '') {
            $error = 'Nombre y email son obligatorios.';
            $usuario = User::buscarPorId($id);
            $rolesTodos = Rol::obtenerTodos();
            $rolesUsuario = User::obtenerRoles($id);
            return $this->view('admin/editar_usuario', compact('usuario', 'rolesTodos', 'rolesUsuario', 'error'));
        }

        // Actualiza nombre y email
        User::actualizar($id, $nombre, $email);

        // Actualiza roles (puedes hacer que reemplace todos)
        $db = \Core\Database::getConnection();
        $db->prepare("DELETE FROM usuario_rol WHERE usuario_id = ?")->execute([$id]);
        foreach ($roles as $rol_id) {
            User::asignarRol($id, $rol_id);
        }

        header('Location: /admin/usuarios');
        exit;
    }

    public function eliminarUsuario($id) {
        Auth::requireRole('administrador');
        User::eliminar($id);
        header('Location: /admin/usuarios');
    }


    public function verRoles($id) {
        Auth::requireRole('administrador');
        $usuario = User::buscarPorId($id);
        $roles = User::obtenerRoles($id);
        $this->view('admin/ver_roles', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function formCrearCurso() {
        Auth::requireRole('administrador');
        $this->view('admin/crear_curso');
    }

    public function crearCurso() {
        Auth::requireRole('administrador');

        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $categoria = trim($_POST['categoria']);
        $nivel = $_POST['nivel'] ?? 'básico';
        $duracion = (int) $_POST['duracion'];
        $estado = $_POST['estado'] ?? 'activo';
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $cupo_maximo = (int) ($_POST['cupo_maximo'] ?? 0);
        $visibilidad = $_POST['visibilidad'] ?? 'publico';

        if ($nombre === '' || $descripcion === '' || $categoria === '') {
            $this->view('admin/crear_curso', ['error' => 'Todos los campos obligatorios deben completarse.']);
            return;
        }

        // Manejo de imagen de portada
        $imagenRuta = null;
        if (!empty($_FILES['imagen_portada']['tmp_name'])) {
            $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen_portada']['name']);
            $rutaDestino = __DIR__ . '/../../public/uploads/cursos/' . $nombreArchivo;

            if (!is_dir(dirname($rutaDestino))) {
                mkdir(dirname($rutaDestino), 0777, true);
            }

            if (move_uploaded_file($_FILES['imagen_portada']['tmp_name'], $rutaDestino)) {
                $imagenRuta = '/uploads/cursos/' . $nombreArchivo;
            } else {
                $this->view('admin/crear_curso', ['error' => 'Error al subir la imagen.']);
                return;
            }
        }

        $datos = [
            'nombre'         => $nombre,
            'descripcion'    => $descripcion,
            'creado_por'     => $_SESSION['usuario_id'],
            'categoria'      => $categoria,
            'nivel'          => $nivel,
            'duracion'       => $duracion,
            'imagen_portada' => $imagenRuta,
            'estado'         => $estado,
            'fecha_inicio'   => $fecha_inicio ?: null,
            'fecha_fin'      => $fecha_fin ?: null,
            'cupo_maximo'    => $cupo_maximo,
            'visibilidad'    => $visibilidad
        ];

        $exito = Curso::crear($datos);

        if ($exito) {
            header('Location: /admin');
        } else {
            $this->view('admin/crear_curso', ['error' => 'Error al crear el curso.']);
        }
    }

}
