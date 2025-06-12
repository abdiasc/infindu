<?php
namespace App\Controllers;


use Core\Controller;

class UserController extends Controller {
    public function index() {
        $this->view('users/index', ['title' => 'Usuarios']);
    }
}
