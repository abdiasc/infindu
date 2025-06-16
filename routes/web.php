<?php

// Rutas públicas
$router->get('/', 'HomeController@index');
$router->get('nosotros', 'HomeController@about');

// Autenticación
$router->get('login', 'AuthController@mostrarLogin');
$router->post('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');

$router->get('registro', 'AuthController@registroForm');
$router->post('registro', 'AuthController@registrar');
$router->post('registro/user', 'AuthController@registroAsignarRol');

// Paneles de usuario
$router->get('profesor', 'ProfesorController@dashboard');
$router->get('/profesor/perfil', 'ProfesorController@perfil');

$router->get('estudiante', 'EstudianteController@dashboard');
$router->get('/estudiante/perfil', 'EstudianteController@perfil');

// Rutas generales de recursos
$router->get('users', 'UserController@index');
$router->get('cursos', 'CursoController@home');

$router->get('profesores', 'ProfesorController@index');
$router->get('estudiantes', 'EstudianteController@index');

// Panel de administración general
$router->get('admin', 'AdminController@dashboard');

// Gestión de usuarios (Admin)
$router->get('/admin/usuarios', 'AdminController@usuarios');
$router->get('/users/crear', 'AdminController@crearUsuario');
$router->post('/users/crear', 'AdminController@guardarUsuario');
$router->get('/users/editar/{id}', 'AdminController@editarUsuario');
$router->post('/users/editar', 'AdminController@actualizarUsuario');
$router->get('/users/eliminar/{id}', 'AdminController@eliminarUsuario');
$router->get('/users/roles/{id}', 'AdminController@verRoles');

// Gestión de cursos (Admin)
$router->get('admin/cursos', 'CursoController@index');
$router->get('/admin/curso/{id}', 'CursoController@ver');
$router->get('admin/crear-curso', 'AdminController@formCrearCurso');
$router->post('admin/crear-curso', 'AdminController@crearCurso');
$router->post('/admin/curso/asignar-profesor', 'CursoController@asignarProfesor');

// Gestión de roles
$router->get('/admin/roles', 'RolController@index');
$router->get('/roles/crear', 'RolController@create');
$router->post('/roles/store', 'RolController@store');
$router->get('/roles/edit/{id}', 'RolController@edit');
$router->post('/roles/edit/{id}', 'RolController@update');
$router->get('/roles/delete/{id}', 'RolController@delete');

// Gestión de permisos
$router->get('/admin/permisos', 'PermisoController@index');
$router->get('/permisos/crear', 'PermisoController@crear');
$router->post('/permisos/guardar', 'PermisoController@guardar');
$router->get('/permisos/editar/{id}', 'PermisoController@editar');
$router->post('/permisos/actualizar/{id}', 'PermisoController@actualizar');
$router->get('/permisos/eliminar/{id}', 'PermisoController@eliminar');

// Asignación de permisos a roles
$router->get('/roles/{id}/permisos', 'PermisoController@asignarPermisos');
$router->post('/roles/permisos/guardar', 'PermisoController@guardarAsignacion');

// Gestión de lecciones
$router->get('/lecciones/curso/{id}', 'LeccionController@index');
$router->get('/lecciones/crear/{curso_id}', 'LeccionController@crear');
$router->post('/lecciones/guardar', 'LeccionController@guardar');
$router->get('/lecciones/editar/{id}', 'LeccionController@editar');
$router->post('/lecciones/actualizar/{id}', 'LeccionController@actualizar');
$router->get('/lecciones/eliminar/{id}/{curso_id}', 'LeccionController@eliminar');
$router->post('/admin/lecciones/crear', 'LeccionController@crear'); // Ojo: posible duplicado de lógica

$router->get('/perfil/completar', 'PerfilController@completar');
$router->post('/perfil/guardar', 'PerfilController@guardar');

$router->get('/perfil/completar_estudiante', 'PerfilController@completarEstudiante');
$router->post('/perfil/guardar_estudiante', 'PerfilController@guardarEstudiante');

$router->get('/error/403', 'ErrorController@error403');

$router->get('/cursos/{id}', 'CursoController@verPublico');

$router->get('/categorias', 'CategoriaController@index');
$router->get('/categorias/crear', 'CategoriaController@create');
$router->post('/categorias/guardar', 'CategoriaController@store');
$router->get('/categorias/editar/{id}', 'CategoriaController@edit');   
$router->post('/categorias/actualizar/{id}', 'CategoriaController@update');
$router->get('/categorias/eliminar/{id}', 'CategoriaController@delete');   
$router->get('/categorias/{id}', 'CategoriaController@verPublico');


// /routes.php
$router->get('/inscripciones/formulario', 'InscripcionController@formulario');
$router->post('/inscripciones/inscribir', 'InscripcionController@inscribir');

$router->get('/estudiante/cursos', 'PerfilController@cursosInscritos');
$router->get('/profesor/curso/{id}/estudiantes', 'CursoController@verEstudiantes');


$router->get('/curso/ver/{id}', 'CursoController@verContenido');
