<?php
namespace Core;

class Router {
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($uri, $action) {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action) {
        $this->addRoute('POST', $uri, $action);
    }

    protected function addRoute($method, $uri, $action) {
        $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', trim($uri, '/'));
        $regex = "#^" . $pattern . "$#";
        $this->routes[$method][$regex] = $action;
    }

    public function dispatch($uri, $method) {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');

        foreach ($this->routes[$method] as $pattern => $action) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remueve el match completo

                return $this->callControllerAction($action, $matches);
            }
        }

        // Página no encontrada
        http_response_code(404);
        //require __DIR__ . '/../../resources/views/errors/404.php';
        echo "404 - Página no encontrada";
        exit;
    }

    protected function callControllerAction($action, $params = []) {
        [$controllerName, $method] = explode('@', $action);
        $controllerClass = "App\\Controllers\\$controllerName";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();

            if (method_exists($controller, $method)) {
                return call_user_func_array([$controller, $method], $params);
            }
        }

        http_response_code(404);
        echo "404 - Acción no encontrada";
    }
}

