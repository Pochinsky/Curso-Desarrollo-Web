<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\PropertyController;
use Controller\SellerController;
use Controller\HomeController;

$router = new Router();

// admin route
$router->get('/admin', [PropertyController::class, 'index']);
// properties GET routes
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
// sellers GET routes
$router->get('/sellers/create', [SellerController::class, 'create']);
$router->get('/sellers/update', [SellerController::class, 'update']);
// properties POST routes
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);
// sellers POST routes
$router->post('/sellers/create', [SellerController::class, 'create']);
$router->post('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/delete', [SellerController::class, 'delete']);
// home routes
$router->get('/',[HomeController::class, 'index']);
$router->get('/aboutus',[HomeController::class, 'aboutus']);
$router->get('/properties',[HomeController::class, 'properties']);
$router->get('/property',[HomeController::class, 'property']);
$router->get('/blog',[HomeController::class, 'blog']);
$router->get('/entry',[HomeController::class, 'entry']);
$router->get('/contact',[HomeController::class, 'contact']);
$router->post('/contact',[HomeController::class, 'contact']);


$router->checkRoutes();
