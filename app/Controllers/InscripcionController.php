<?php
namespace App\Controllers;

use App\Middleware\Auth;
use App\Models\Inscripcion;
use Core\Controller;
use App\Models\Estudiante;

class InscripcionController extends Controller
{
    public function formulario()
    {
        Auth::requireRole('estudiante');

        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $cursos = Inscripcion::obtenerCursosActivos();
        $estudiante = Estudiante::obtenerPorUsuario($usuario_id);

        if (!$estudiante) {
            $this->view('inscripciones/formulario', [
                'title' => 'Inscribirse a un curso',
                'cursos' => $cursos,
                'estudiante' => $estudiante,
                'idsInscritos' => []
            ]);
            return;
        }

        $cursosInscritos = Inscripcion::cursosPorEstudiante($estudiante['usuario_id']);
        $idsInscritos = array_column($cursosInscritos, 'id');

        $this->view('inscripciones/formulario', [
            'title' => 'Inscribirse a un curso',
            'cursos' => $cursos,
            'estudiante' => $estudiante,
            'idsInscritos' => $idsInscritos
        ]);
    }


    public function inscribir()
    {
        Auth::requireRole('estudiante');
        $usuario_id = $_SESSION['usuario_id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estudianteId = $_SESSION['usuario_id']; // o como manejes tu sesión
            $cursoId = (int)($_POST['curso_id'] ?? 0);
            $mensaje = '';

            if (Inscripcion::yaInscrito($estudianteId, $cursoId)) {
                $mensaje = 'Inscrito';
            } elseif (!Inscripcion::hayCupo($cursoId)) {
                $mensaje = 'El curso está lleno.';
            } else {
                Inscripcion::inscribir($estudianteId, $cursoId);
                $mensaje = 'Inscripción realizada con éxito.';
            }

            $cursos = Inscripcion::obtenerCursosActivos();
            $estudiante = Estudiante::obtenerPorUsuario($usuario_id);
            $cursosInscritos = Inscripcion::cursosPorEstudiante($estudiante['usuario_id']);
            $idsInscritos = array_column($cursosInscritos, 'id');
            $this->view('inscripciones/formulario', [
                'title' => 'Inscribirse a un curso',
                'cursos' => $cursos,
                'estudiante' => $estudiante,
                'idsInscritos' => $idsInscritos,
                'mensaje' => $mensaje
            ]);
        }
    }
}
