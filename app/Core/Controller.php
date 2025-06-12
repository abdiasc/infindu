<?php
namespace Core;

class Controller {
    protected $viewsPath = 'resources/views/';
    //protected $viewsPath = __DIR__ . '/../Views/';

    public function view($view, $data = []) {
        extract($data);

        ob_start();
        require $this->viewsPath . $view . '.php';
        $content = ob_get_clean();

        require $this->viewsPath . 'layouts/main.php';
    }
}
