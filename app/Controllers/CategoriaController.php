<?php
namespace App\Controllers;

use App\Middleware\Auth;
use Core\Controller;
use App\Models\Categorias;


class CategoriaController extends Controller
{
    public function index()
    {
        Auth::requireRole('administrador');
        $categorias = Categorias::obtenerTodos();
        $this->view('categorias/index', [
            'title' => 'Lista de Categorías',
            'categorias' => $categorias
        ]);
    }

    public function create()
    {
        Auth::requireRole('administrador');
        $this->view('categorias/crear', [
            'title' => 'Crear Categoría'
        ]);
    }

    public function store()
    {
        Auth::requireRole('administrador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $color = trim($_POST['color'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            // Validar que el nombre no esté vacío
            if ($nombre !== '') {
                // Crear la categoría
                Categorias::crear($nombre, $color, $descripcion);
            }else {
                // Manejar el error de validación
                $_SESSION['error'] = 'El nombre de la categoría es obligatorio.';
            }
            
            header('Location: /categorias');
            exit;
        }
    }

    public function edit($id)
    {
        Auth::requireRole('administrador');
        $categoria = Categorias::obtenerPorId((int)$id);
        if (!$categoria) {
            header('Location: /admin/categorias');
            exit;
        }
        $this->view('categorias/edit', [
            'title' => 'Editar Categoría',
            'categoria' => $categoria
        ]);
    }

    public function update($id)
    {
        Auth::requireRole('administrador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');

            if ($nombre !== '') {
                Categorias::actualizar((int)$id, $nombre);
            }
            header('Location: /admin/categorias');
            exit;
        }
    }

    public function delete($id)
    {
        Auth::requireRole('administrador');
        Categorias::eliminar((int)$id);
        header('Location: /admin/categorias');
        exit;
    }
}





?>