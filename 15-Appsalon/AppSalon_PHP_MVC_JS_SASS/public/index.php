<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\Admincontroller;
use Controllers\APIController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\CitaController;
use Controllers\ServicioController;
use Model\Cita;
use Model\CitaServicio;

$router = new Router();


// Iniciar sesión
$router->get('/', [LoginController::class, 'loginGet']);
$router->post('/', [LoginController::class, 'loginPost']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar el Password
$router->get('/olvide', [LoginController::class, 'olvideGet']);
$router->post('/olvide', [LoginController::class, 'olvidePost']);
$router->get('/recuperar', [LoginController::class, 'recuperarGet']);
$router->post('/recuperar', [LoginController::class, 'recuperarPost']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crearGet']);
$router->post('/crear-cuenta', [LoginController::class, 'crearPost']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// Área Privada
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [Admincontroller::class, 'index']);

// API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crearGet']);
$router->post('/servicios/crear', [ServicioController::class, 'crearPost']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizarGet']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizarPost']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();