<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Profesor;

class ProfesorController extends Controller {
    public function index() {
        $this->view('profesores/index', ['title' => 'Profesores']);
    }

    public function dashboard() {
        Auth::requireRole('profesor');

        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $profesor = Profesor::obtenerPorUsuario($usuario_id);

        // Si no tiene datos completos (puedes definir qué campos son obligatorios)
        $mostrarAlerta = false;
        if (!$profesor || empty($profesor['especialidad'])) {
            $mostrarAlerta = true;
        }

        $this->view('profesores/dashboard', [
            'profesor' => $profesor,
            'mostrarAlerta' => $mostrarAlerta,
        ]);
    }
}
