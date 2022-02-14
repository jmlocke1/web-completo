<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class Admincontroller {
	public static function index( Router $router ){
		if(!isset($_SESSION)){
			session_start();
		}
		$citas = AdminCita::getCitas();
		
		$router->render('admin/index', [
			'nombre' => $_SESSION['nombre'],
			'citas' => $citas
		]);
	}
}