<?php
// index.php - Punto de entrada

spl_autoload_register(function($class) {
    // Quitar el prefijo 'App\' para que cargue desde 'app/'
    if (strpos($class, 'App\\') === 0) {
        $class = substr($class, 4); // elimina 'App\' (4 caracteres)
    }
    $path = str_replace('\\', '/', $class);
    $file = __DIR__ . '/app/' . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "❌ No se encontró la clase: $class en $file<br>";
    }
});

session_start();
require_once __DIR__ . '/app/Helpers.php';
$config = require __DIR__ . '/config/config.php';

$router = new Core\Router();
require_once __DIR__ . '/routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
