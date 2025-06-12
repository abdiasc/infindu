<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Estudiante;

class EstudianteController extends Controller {
    public function dashboard() {
        Auth::requireRole('estudiante');

        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $estudiante = Estudiante::obtenerPorUsuario($usuario_id);

        $mostrarAlerta = false;
        if (!$estudiante || empty($estudiante['carrera'])) {
            $mostrarAlerta = true;
        }
  
        $this->view('estudiante/dashboard', [
            'estudiante' => $estudiante,
            'mostrarAlerta' => $mostrarAlerta,
        ]);


    }
    public function index() {
        $this->view('estudiante/index');
    }
}
