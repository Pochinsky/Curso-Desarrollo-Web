<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\PropertyController;

$router = new Router();

// define routes
$router->get('/admin', [PropertyController::class, 'index']);
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);


$router->checkRoutes();
