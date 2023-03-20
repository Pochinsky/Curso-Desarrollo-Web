<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\PropertyController;
use Controller\SellerController;

$router = new Router();

// define GET routes
$router->get('/admin', [PropertyController::class, 'index']);
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->get('/sellers/create', [SellerController::class, 'create']);
$router->get('/sellers/update', [SellerController::class, 'update']);
// define POST routes
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);
$router->post('/sellers/create', [SellerController::class, 'create']);
$router->post('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/delete', [SellerController::class, 'delete']);


$router->checkRoutes();
