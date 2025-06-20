<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Profesor;
use App\Models\User;
use App\Models\Curso;

class ProfesorController extends Controller {
    public function index() {
        $this->view('profesores/index', ['title' => 'Profesores']);
    }

    public function dashboard()
    {
        Auth::requireRole('profesor');

        $usuario_id = $_SESSION['usuario_id'] ?? null;

        // Obtener datos del profesor
        $profesor = Profesor::obtenerPorUsuario($usuario_id);

        // Verificar si el perfil está incompleto
        $mostrarAlerta = false;
        if (!$profesor || empty($profesor['especialidad'])) {
            $mostrarAlerta = true;
        }

        // Obtener cursos asignados al profesor
        $cursosAsignados = Profesor::obtenerCursosAsignados($usuario_id);

        // Enviar datos a la vista
        $this->view('profesores/dashboard', [
            'profesor' => $profesor,
            'mostrarAlerta' => $mostrarAlerta,
            'cursosAsignados' => $cursosAsignados
        ]);
    }
    public function perfil()
    {
        Auth::requireRole('profesor');

        $usuario_id = $_SESSION['usuario_id'] ?? null;

        // Obtener datos del profesor
        $profesor = Profesor::obtenerPorUsuario($usuario_id);
        $usuario = User::buscarPorId($usuario_id);

       
        // Enviar datos a la vista
        $this->view('profesores/perfil', [
            'profesor' => $profesor,
            'usuario' => $usuario,
            'title' => 'Perfil del Profesor'
        ]);
    }

    public function misCursos() {
        Auth::requireRole('profesor');

        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $profesor = Profesor::obtenerPorUsuario($usuario_id);
        $cursos = Profesor::obtenerCursosAsignados($usuario_id);

        $this->view('profesores/cursos', [
            'title' => 'Mis Cursos Asignados',
            'profesor' => $profesor,
            'cursos' => $cursos
        ]);
    }



}
