<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Leccion;
use App\Models\Curso;
use App\Models\Profesor;
use App\Middleware\Auth;

class LeccionController extends Controller {

        private $leccionModel;

        public function __construct() {
            $this->leccionModel = new Leccion();
        }

        public function index($curso_id) {
            $lecciones = $this->leccionModel->todasPorCurso($curso_id);
            $this->view('lecciones/index', ['lecciones' => $lecciones, 'curso_id' => $curso_id]);
        }

        public function crear1($curso_id) {
            $this->view('lecciones/crear', ['curso_id' => $curso_id]);
        }

        public function crear() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $datos = [
                    'curso_id' => $_POST['curso_id'],
                    'titulo' => $_POST['titulo'],
                    'contenido' => $_POST['contenido'],
                    'url_video' => $_POST['url_video'],
                    'orden' => $_POST['orden']
                ];

                Leccion::crear($datos);

                // Redireccionar de nuevo al curso
                header('Location: /admin/curso/' . $_POST['curso_id']);
                exit;
            }
        }



        public function guardar() {
            $datos = [
                'curso_id' => $_POST['curso_id'],
                'titulo' => $_POST['titulo'],
                'contenido' => $_POST['contenido'],
                'url_video' => $_POST['url_video'],
                'orden' => $_POST['orden'] ?? 1
            ];
            $this->leccionModel->crear($datos);
            header("Location: /lecciones/curso/" . $_POST['curso_id']);
        }

        public function editar($id) {
            $leccion = $this->leccionModel->obtener($id);
            $this->view('lecciones/editar', ['leccion' => $leccion]);
        }

        public function actualizar($id) {
            $datos = [
                'titulo' => $_POST['titulo'],
                'contenido' => $_POST['contenido'],
                'url_video' => $_POST['url_video'],
                'orden' => $_POST['orden'] ?? 1
            ];
            $this->leccionModel->actualizar($id, $datos);
            header("Location: /lecciones/curso/" . $_POST['curso_id']);
        }

        public function eliminar($id, $curso_id) {
            $this->leccionModel->eliminar($id);
            header("Location: /lecciones/curso/" . $curso_id);
        }

        public function ver($id)
        {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: /login');
                exit;
            }

            $usuarioId = $_SESSION['usuario_id'];

            $leccion = Leccion::obtener($id);

            if (!$leccion) {
                header('Location: /error/403');
                exit;
            }

            $cursoId = $leccion['curso_id'];

            // Validar que el usuario esté inscrito en el curso de esta lección
            if (!Curso::estaInscrito($usuarioId, $cursoId)) {
                header('Location: /error/403');
                exit;
            }

            $leccionAnterior = Leccion::obtenerAnterior($id, $cursoId);
            $leccionSiguiente = Leccion::obtenerSiguiente($id, $cursoId);

            $curso = Curso::obtenerPorIdCursos($cursoId);

            $this->view('lecciones/ver', [
                'leccion' => $leccion,
                'curso' => $curso,
                'leccionAnterior' => $leccionAnterior,
                'leccionSiguiente' => $leccionSiguiente,
            ]);
        }

        // Mostrar formulario de crear lección
    public function crearLeccion($cursoId)
    {
        // Verifica que el usuario tenga el rol de profesor
        Auth::requireRole('profesor');

        $usuarioId = $_SESSION['usuario_id'] ?? null;

        // Obtiene el perfil del profesor por su usuario_id
        $profesor = Profesor::obtenerPorUsuario($usuarioId);
        $curso = Curso::obtenerPorIdCursos($cursoId);

        // Validación básica
        if (!$profesor || !$curso) {
            header('Location: /error/403');
            exit;
        }

        // Validación: el usuario debe estar asignado como profesor de ese curso
        if (!Profesor::estaAsignadoACurso($profesor['usuario_id'], $cursoId)) {
            header('Location: /error/403');
            exit;
        }

        // Mostrar formulario de crear lección
        $this->view('lecciones/crear-leccion', [
            'curso' => $curso
        ]);
    }






        public function guardarLeccion()
        {
            Auth::requireRole('profesor');

            $usuarioId = $_SESSION['usuario_id'] ?? null;
            $profesor = Profesor::obtenerPorUsuario($usuarioId);

            // Verifica que se reciban los datos del formulario
            $cursoId = $_POST['curso_id'] ?? null;
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $contenido = $_POST['contenido'] ?? '';

            if (!$profesor || !$cursoId || !$titulo || !$contenido) {
                die("Faltan datos obligatorios.");
            }

            // Verifica que el profesor esté asignado a este curso
            if (!Profesor::estaAsignadoACurso($profesor['usuario_id'], $cursoId)) {
                header('Location: /error/403');
                exit;
            }

            // Guarda la lección
            $exito = Leccion::crear([
                'curso_id' => $cursoId,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'contenido' => $contenido
            ]);

            if ($exito) {
                header("Location: /cursos/$cursoId");
                exit;
            } else {
                die("Error al guardar la lección.");
            }
        }




    
}
?>
