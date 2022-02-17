<?php
namespace Controllers;
use MVC\Router;

class CitaController {
	public static function index(Router $router){
		iniciaSesión();
		isAuth();
		$router->render('cita/index', [
			'nombre' => $_SESSION['nombre'],
			'id' => $_SESSION['id']
		]);
	}
}