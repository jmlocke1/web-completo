<?php
require_once __DIR__.'/../includes/app.php';
use MVC\Router;
use Controllers\PropiedadController;
$router = new Router();
$router->get('/', 'funcion_raiz');

$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crearGet']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crearPost']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizarGet']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizarPost']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);
$router->get('/propiedades/eliminar', [PropiedadController::class, 'eliminarGet']);

$router->comprobarRutas();