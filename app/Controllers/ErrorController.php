<?php
namespace App\Controllers;

use Core\Controller;

class ErrorController extends Controller
    {
        // Error 403 - Acceso denegado
        public function error403() {
            http_response_code(403);
            $this->view('error/403');
        }
    }

?>