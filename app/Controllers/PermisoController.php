<?php
    namespace App\Controllers;

    use App\Models\Permiso;
    use App\Models\Rol;
    use App\Models\RolPermiso;
    use Core\Controller;

    class PermisoController extends Controller {
        public function index() {
            $permisos = Permiso::obtenerTodos();
            $this->view('permisos/index', compact('permisos'));
        }

        public function crear() {
            $this->view('permisos/crear');
        }

        public function guardar() {
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            Permiso::crear($nombre, $descripcion);
            header('Location: /admin/permisos');
            exit;
        }

        public function editar($id) {
            $permiso = Permiso::obtenerPorId($id);
            $this->view('permisos/editar', compact('permiso'));
        }

        public function actualizar($id) {
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            Permiso::actualizar($id, $nombre, $descripcion);
            header('Location: /admin/permisos');
            exit;
        }

        public function eliminar($id) {
            Permiso::eliminar($id);
            header('Location: /permisos');
            exit;
        }

        public function asignarPermisos($rol_id) {
            $permisos = Permiso::obtenerTodos();
            $asignados = RolPermiso::obtenerPorRol($rol_id);
            $this->view('permisos/asignar', compact('rol_id', 'permisos', 'asignados'));
            
        }

        public function guardarAsignacion() {
            $rol_id = $_POST['rol_id'];
            $permisos = $_POST['permisos'] ?? [];

            // Aquí puedes eliminar todos los permisos anteriores primero si deseas "resetear"
            $db = \Core\Database::getConnection();
            $db->prepare("DELETE FROM rol_permiso WHERE rol_id = ?")->execute([$rol_id]);

            foreach ($permisos as $permiso_id) {
                RolPermiso::asignar($rol_id, $permiso_id);
            }

            header("Location: /roles");
            exit;
        }
    }
?>