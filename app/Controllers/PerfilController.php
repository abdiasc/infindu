<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\Auth;
use App\Models\Estudiante;
use App\Models\Profesor;

class PerfilController extends Controller {

    public function completarEstudiante() {
        Auth::requireLogin(); // <- punto y coma corregido

        $usuario_id = $_SESSION['usuario_id'] ?? null;

        // Si ya está registrado como profesor, redirigir al dashboard
        if (Estudiante::obtenerPorUsuario($usuario_id)) {
            header('Location: /estudiante/dashboard');
            exit;
        }

        $this->view('perfil/completarEstudiante', [
            'title' => 'Completar Perfil de Estudiante'
        ]);
    }

    public function completar() {
        Auth::requireLogin(); // <- punto y coma corregido

        $usuario_id = $_SESSION['usuario_id'] ?? null;

        // Si ya está registrado como profesor, redirigir al dashboard
        if (Profesor::obtenerPorUsuario($usuario_id)) {
            header('Location: /profesor/dashboard');
            exit;
        }

        $this->view('perfil/completar', [
            'title' => 'Completar Perfil de Profesor'
        ]);
    }


    public function guardar()
    {
        Auth::requireLogin();

        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $especialidad = $_POST['especialidad'] ?? '';
        $titulo_academico = $_POST['titulo_academico'] ?? null;
        $experiencia_anios = $_POST['experiencia_anios'] ?? null;
        $fecha_ingreso = $_POST['fecha_ingreso'] ?? null;
        $avatarPath = null;
        $biografia = $_POST['biografia'] ?? null;

        // Procesar imagen si se cargó
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['avatar']['name']);
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $nuevoNombre = 'avatar_' . uniqid() . '.' . $extension;

            $directorioDestino = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0755, true);
            }

            $rutaFinal = $directorioDestino . $nuevoNombre;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $rutaFinal)) {
                // Crear imagen desde archivo
                list($anchoOriginal, $altoOriginal) = getimagesize($rutaFinal);
                $lado = min($anchoOriginal, $altoOriginal);

                // Coordenadas para recorte centrado
                $x = ($anchoOriginal - $lado) / 2;
                $y = ($altoOriginal - $lado) / 2;

                // Crear imagen original según tipo
                switch (strtolower($extension)) {
                    case 'jpg':
                    case 'jpeg':
                        $imagenOriginal = imagecreatefromjpeg($rutaFinal);
                        break;
                    case 'png':
                        $imagenOriginal = imagecreatefrompng($rutaFinal);
                        break;
                    case 'gif':
                        $imagenOriginal = imagecreatefromgif($rutaFinal);
                        break;
                    default:
                        unlink($rutaFinal);
                        die('Formato de imagen no soportado.');
                }

                // Crear lienzo cuadrado (1:1)
                $tamanoFinal = 300;
                $imagenCuadrada = imagecreatetruecolor($tamanoFinal, $tamanoFinal);

                // Activar transparencia si es PNG o GIF
                if (in_array(strtolower($extension), ['png', 'gif'])) {
                    imagecolortransparent($imagenCuadrada, imagecolorallocatealpha($imagenCuadrada, 0, 0, 0, 127));
                    imagealphablending($imagenCuadrada, false);
                    imagesavealpha($imagenCuadrada, true);
                }

                // Recortar y redimensionar
                imagecopyresampled(
                    $imagenCuadrada, $imagenOriginal,
                    0, 0,       // destino
                    $x, $y,     // origen (recorte)
                    $tamanoFinal, $tamanoFinal,   // tamaño destino
                    $lado, $lado                 // tamaño origen
                );

                // Guardar imagen redimensionada
                switch (strtolower($extension)) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($imagenCuadrada, $rutaFinal, 90);
                        break;
                    case 'png':
                        imagepng($imagenCuadrada, $rutaFinal);
                        break;
                    case 'gif':
                        imagegif($imagenCuadrada, $rutaFinal);
                        break;
                }

                // Liberar memoria
                imagedestroy($imagenOriginal);
                imagedestroy($imagenCuadrada);

                // Ruta relativa para base de datos
                $avatarPath = '/uploads/avatars/' . $nuevoNombre;
            }
        }

        if (!empty($especialidad)) {
            Profesor::crear([
                'usuario_id' => $usuario_id,
                'especialidad' => $especialidad,
                'titulo_academico' => $titulo_academico,
                'experiencia_anios' => $experiencia_anios,
                'fecha_ingreso' => $fecha_ingreso,
                'biografia' => $biografia,
                'avatar' => $avatarPath,
            ]);

            header('Location: /profesor');
            exit;
        }

        $this->view('perfil/completar', [
            'title' => 'Completar Perfil de Profesor',
            'error' => 'La especialidad es requerida.'
        ]);
    }



    public function guardarEstudiante()
    {
        Auth::requireLogin();
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $carrera = $_POST['carrera'] ?? '';
        $semestre = $_POST['semestre'] ?? null;
        $matricula = $_POST['matricula'] ?? null;
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $avatarPath = null;

        // Procesar imagen si se cargó
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['avatar']['name']);
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $nuevoNombre = 'avatar_estudiante_' . uniqid() . '.' . $extension;

            $directorioDestino = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0755, true);
            }

            $rutaFinal = $directorioDestino . $nuevoNombre;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $rutaFinal)) {
                // Redimensionar imagen a cuadrado 1:1
                list($anchoOriginal, $altoOriginal) = getimagesize($rutaFinal);
                $lado = min($anchoOriginal, $altoOriginal);
                $x = ($anchoOriginal - $lado) / 2;
                $y = ($altoOriginal - $lado) / 2;

                // Crear imagen original
                switch (strtolower($extension)) {
                    case 'jpg':
                    case 'jpeg':
                        $imagenOriginal = imagecreatefromjpeg($rutaFinal);
                        break;
                    case 'png':
                        $imagenOriginal = imagecreatefrompng($rutaFinal);
                        break;
                    case 'gif':
                        $imagenOriginal = imagecreatefromgif($rutaFinal);
                        break;
                    default:
                        unlink($rutaFinal);
                        die('Formato de imagen no soportado.');
                }

                $tamanoFinal = 300;
                $imagenCuadrada = imagecreatetruecolor($tamanoFinal, $tamanoFinal);

                // Soporte para transparencia
                if (in_array(strtolower($extension), ['png', 'gif'])) {
                    imagecolortransparent($imagenCuadrada, imagecolorallocatealpha($imagenCuadrada, 0, 0, 0, 127));
                    imagealphablending($imagenCuadrada, false);
                    imagesavealpha($imagenCuadrada, true);
                }

                imagecopyresampled(
                    $imagenCuadrada, $imagenOriginal,
                    0, 0,   // destino
                    $x, $y, // origen
                    $tamanoFinal, $tamanoFinal,
                    $lado, $lado
                );

                // Guardar imagen redimensionada
                switch (strtolower($extension)) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($imagenCuadrada, $rutaFinal, 90);
                        break;
                    case 'png':
                        imagepng($imagenCuadrada, $rutaFinal);
                        break;
                    case 'gif':
                        imagegif($imagenCuadrada, $rutaFinal);
                        break;
                }

                imagedestroy($imagenOriginal);
                imagedestroy($imagenCuadrada);

                // Ruta relativa para guardar en la BD
                $avatarPath = '/uploads/avatars/' . $nuevoNombre;
            }
        }

        if (!empty($carrera)) {
            Estudiante::crear([
                'usuario_id' => $usuario_id,
                'carrera' => $carrera,
                'semestre' => $semestre,
                'matricula' => $matricula,
                'fecha_nacimiento' => $fecha_nacimiento,
                'avatar' => $avatarPath,
            ]);

            header('Location: /estudiante');
            exit;
        }

        $this->view('perfil/completarEstudiante', [
            'title' => 'Completar Perfil de Estudiante',
            'error' => 'La carrera es requerida.'
        ]);
    }
}

