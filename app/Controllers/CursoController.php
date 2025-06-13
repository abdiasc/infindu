<?php
namespace App\Controllers;


use Core\Controller;
use App\Models\Curso;
use App\Models\User; // Asegúrate de importar el modelo Usuario
use App\Models\Leccion;
use App\Models\Profesor; // Asegúrate de importar el modelo Profesor

use App\Middleware\Auth;

class CursoController extends Controller {
    public function index() {
        //$cursos = Curso::obtenerTodos();
        Auth::requireRole('administrador'); // Asegúrate de que el usuario tenga el rol adecuado
        $cursos = Curso::obtenerTodosConProfesor();
        $this->view('cursos/index', [
            'title' => 'Lista de cursos',
            'cursos' => $cursos
        ]);
    }
    public function home() {
        $cursos = Curso::obtenerTodos();
        $this->view('cursos/home', [
            'title' => 'Lista de cursos',
            'cursos' => $cursos
        ]);
    }

    public function ver($id) {
        $curso = Curso::obtenerPorId($id);
        $lecciones = Leccion::todasPorCurso($id);
        $profesores = User::obtenerProfesores(); // Lista para asignar
        $profesorAsignado = Curso::obtenerProfesorAsignado($id); // Nuevo
        $profesorDatos = Profesor::obtenerPorUsuario($profesorAsignado['usuario_id'] ?? null);

        if (!$curso) {
            // Redireccionar o lanzar error si no existe
            header('Location: /admin/cursos');
            exit;
        }

        $this->view('cursos/ver', [
            'title' => 'Detalle del Curso',
            'curso' => $curso,
            'lecciones' => $lecciones ?? [],
            'profesores' => $profesores ?? [],
            'profesorAsignado' => $profesorAsignado ?: null,
            'profesorDatos' => $profesorDatos, // Puedes pasar los datos del profesor si es necesario   
        ]);
    }


    public function asignarProfesor() {
            // Suponiendo método POST
            $curso_id = $_POST['curso_id'];
            $profesor_id = $_POST['profesor_id'];

            // Validar que el usuario sea profesor
            $roles = User::obtenerRoles($profesor_id);
            if (!in_array('profesor', $roles)) {
                $_SESSION['error'] = "El usuario seleccionado no es profesor.";
                header("Location: /admin/curso/$curso_id");
                exit;
            }

            // Asignar profesor
            $asignado = Curso::asignarProfesor($curso_id, $profesor_id);

            if ($asignado) {
                $_SESSION['success'] = "Profesor asignado correctamente.";
            } else {
                $_SESSION['error'] = "No se pudo asignar el profesor (ya está asignado o error).";
            }

            header("Location: /admin/curso/$curso_id");
            exit;
        }

    



}
