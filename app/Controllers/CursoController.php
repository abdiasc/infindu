<?php
namespace App\Controllers;


use Core\Controller;
use App\Models\Curso;
use App\Models\User; // Asegúrate de importar el modelo Usuario
use App\Models\Leccion;
use App\Models\Profesor; // Asegúrate de importar el modelo Profesor
use App\Models\Inscripcion;
use App\Middleware\Auth;
use Core\Database;
use App\Models\Archivo;

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


    public function verPublico($id) {

       
        $curso = Curso::obtenerPorId($id);
        $lecciones = Leccion::todasPorCurso($id);
        $profesores = User::obtenerProfesores(); // Lista para asignar
        $profesorAsignado = Curso::obtenerProfesorAsignado($id);
        $profesorDatos = Profesor::obtenerPorUsuario($profesorAsignado['usuario_id'] ?? null);

        if (!$curso) {
            header('Location: /cursos');
            exit;
        }

        $this->view('cursos/verPublico', [
            'title' => 'Detalle del Curso',
            'curso' => $curso,
            'lecciones' => $lecciones ?? [],
            'profesores' => $profesores ?? [],
            'profesorAsignado' => $profesorAsignado ?: null,
            'profesorDatos' => $profesorDatos ?? null
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

        public function verEstudiantes($cursoId)
        {
            Auth::requireRole('profesor');

            $profesorId = $_SESSION['usuario_id'];
            $db = Database::getConnection();
            $profesor = Profesor::obtenerPorUsuario($profesorId );

            // Verificar que el profesor esté asignado al curso
            $stmt = $db->prepare("SELECT 1 FROM profesor_curso WHERE profesor_id = :profesorId AND curso_id = :cursoId");
            $stmt->bindValue(':profesorId', $profesorId, \PDO::PARAM_INT);
            $stmt->bindValue(':cursoId', $cursoId, \PDO::PARAM_INT);
            $stmt->execute();

            if (!$stmt->fetch()) {
                header('Location: /panel-profesor');
                exit;
            }

            $estudiantes = Inscripcion::estudiantesPorCurso((int)$cursoId);
            $this->view('cursos/estudiantes', [
                'title' => 'Estudiantes Inscritos',
                'profesor' => $profesor,
                'estudiantes' => $estudiantes

            ]);
        }


        public function verContenido($id)
        {
            Auth::requireLogin(); // Asegura que haya sesión iniciada

            $usuarioId = $_SESSION['usuario_id'];

            // Validar que esté inscrito al curso
            if (!Curso::estaInscrito($usuarioId, $id)) {
                header('Location: /error/403');
                exit;
            }

            $curso = Curso::obtenerPorIdCursos($id);
            $lecciones = Leccion::obtenerPorCurso($id);
            $archivos = Archivo::obtenerPorCurso($id);

            $this->view('cursos/verContenido', [
                'title' => 'Contenido del Curso',
                'curso' => $curso,
                'lecciones' => $lecciones,
                'archivos' => $archivos
            ]);
        }




}
