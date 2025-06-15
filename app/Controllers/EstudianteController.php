<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Estudiante;
use App\Models\User;

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
    public function perfil()
    {
        Auth::requireRole('estudiante');
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        // Obtener datos del estudiante
        $estudiante = Estudiante::obtenerPorUsuario($usuario_id);
        $usuario = User::buscarPorId($usuario_id);
        // Enviar datos a la vista
        $this->view('estudiante/perfil', [
            'estudiante' => $estudiante,
            'usuario' => $usuario,
            'title' => 'Perfil del Profesor'
        ]);
    }



    public function index() {
        $this->view('estudiante/index');
    }
}
