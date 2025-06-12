@echo off
REM Crear carpeta raíz del proyecto
mkdir mi_proyecto_php
cd mi_proyecto_php

REM Crear carpetas principales
mkdir app
mkdir app\Controllers
mkdir app\Models
mkdir app\Core

mkdir config

mkdir css
mkdir js
mkdir images

mkdir resources
mkdir resources\views
mkdir resources\views\layouts
mkdir resources\views\partials

mkdir routes

mkdir storage
mkdir storage\logs
mkdir storage\uploads

mkdir vendor

REM Crear archivos vacíos
type nul > app\Controllers\HomeController.php
type nul > app\Models\User.php
type nul > app\Core\Controller.php
type nul > app\Core\Model.php
type nul > app\Core\Router.php
type nul > app\Core\View.php
type nul > app\Helpers.php

type nul > config\config.php

type nul > index.php
type nul > .htaccess

type nul > resources\views\layouts\main.php
type nul > resources\views\partials\header.php
type nul > resources\views\partials\footer.php
type nul > resources\views\home.php
type nul > resources\views\about.php

type nul > routes\web.php

type nul > .gitignore
type nul > README.md
type nul > composer.json

echo Estructura creada con éxito.
pause
