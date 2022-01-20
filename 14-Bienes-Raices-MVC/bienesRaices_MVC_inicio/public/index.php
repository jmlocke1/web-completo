<?php
require_once __DIR__.'/../includes/app.php';

use Controllers\LoginController;
use Controllers\PaginasController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();
$router->get('/', 'funcion_raiz');

// Zona privada
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

// Zona pública
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/blog/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contactoGet']);
$router->post('/contacto', [PaginasController::class, 'contactoPost']);

// Login y autenticación
$router->get('/login', [LoginController::class, 'loginGet']);
$router->post('/login', [LoginController::class, 'loginPost']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();