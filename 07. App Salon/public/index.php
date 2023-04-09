<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\LoginController;

$router = new Router();

$router = new Router();
// crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// recuperar contraseña
$router->get('/password-olvidada', [LoginController::class, 'password_olvidada']);
$router->post('/password-olvidada', [LoginController::class, 'password_olvidada']);
$router->get('/recuperarpassword', [LoginController::class, 'recuperar_password']);
$router->post('/recuperar-password', [LoginController::class, 'recuperar_password']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
