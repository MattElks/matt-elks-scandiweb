<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../Vendor/autoload.php';

use App\Core\Database;
use App\Core\Router;
use App\Controllers\MainController;

$database = new Database();
$router = new Router();

$router->get('/', [MainController::class, 'index']);

$router->get('/add-product', [MainController::class, 'create']);
$router->post('/add-product', [MainController::class, 'create']);

$router->get('/api/read-product', [MainController::class, 'read']);

$router->post('/delete-product', [MainController::class, 'delete']);

$router->resolve();
