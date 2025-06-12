<?php
namespace App\Controllers;

use App\Middleware\Auth;
use Core\Controller;
use App\Models\Rol;

class RolController extends Controller
{
    public function index()
    {
        Auth::requireRole('administrador');
        $roles = Rol::obtenerTodos();
        $this->view('roles/index', [
            'title' => 'Lista de Roles',
            'roles' => $roles
        ]);
    }

    public function create()
    {
        Auth::requireRole('administrador');
        $this->view('roles/create', [
            'title' => 'Crear Rol'
        ]);
    }

    public function store()
    {
        Auth::requireRole('administrador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');

            if ($nombre !== '') {
                Rol::crear($nombre);
            }
            header('Location: /admin/roles');
            exit;
        }
    }

    public function edit($id)
    {
        Auth::requireRole('administrador');
        $rol = Rol::obtenerPorId((int)$id);
        if (!$rol) {
            header('Location: /roles');
            exit;
        }
        $this->view('roles/edit', [
            'title' => 'Editar Rol',
            'rol' => $rol
        ]);
    }

    public function update($id)
    {
        Auth::requireRole('administrador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');

            if ($nombre !== '') {
                Rol::actualizar((int)$id, $nombre);
            }
            header('Location: /admin/roles');
            exit;
        }
    }

    public function delete($id)
    {
        Auth::requireRole('administrador');
        Rol::eliminar((int)$id);
        header('Location: /admin/roles');
        exit;
    }
}
