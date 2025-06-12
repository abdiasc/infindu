<?php
namespace App\Controllers;


use Core\Controller;



class HomeController extends Controller {
    public function index() {
        $this->view('home', ['title' => 'Bienvenido a INFINDU']);
    }
    public function about() {
        $this->view('about', ['title' => 'Acerca de Nosotros']);
    }
}
