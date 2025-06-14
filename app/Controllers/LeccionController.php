<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Leccion;

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
    }
?>
