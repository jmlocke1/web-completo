<?php
require_once __DIR__.'/../includes/app.php';
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();
$router->get('/', 'funcion_raiz');

$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crearGet']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crearPost']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizarGet']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizarPost']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedorController::class, 'crearGet']);
$router->post('/vendedores/crear', [VendedorController::class, 'crearPost']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizarGet']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizarPost']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

$router->comprobarRutas();