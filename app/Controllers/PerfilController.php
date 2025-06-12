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


    public function guardar() {
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
                // Ruta relativa para guardar en BD
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


    public function guardarEstudiante() {
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
                $avatarPath = '/uploads/avatars/' . $nuevoNombre; // Ruta relativa
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

