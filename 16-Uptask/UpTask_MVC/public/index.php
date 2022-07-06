<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use MVC\Router;
$router = new Router();

// Login
$router->get('/', [LoginController::class, 'loginGet']);
$router->post('/', [LoginController::class, 'loginPost']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear Cuenta
$router->get('/crear', [LoginController::class, 'crearGet']);
$router->post('/crear', [LoginController::class, 'crearPost']);

// Formulario de olvidé mi password
$router->get('/olvide', [LoginController::class, 'olvideGet']);
$router->post('/olvide', [LoginController::class, 'olvidePost']);

// Colocar el nuevo password
$router->get('/reestablecer', [LoginController::class, 'reestablecerGet']);
$router->post('/reestablecer', [LoginController::class, 'reestablecerPost']);

// Confirmación de Cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

// ZONA DE PROYECTOS
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->get('/perfil', [DashboardController::class, 'perfil']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();