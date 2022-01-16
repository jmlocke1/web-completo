<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Model\Notification;

class PaginasController {
	public static function index( Router $router ){
		
		$router->render('paginas/index', [
			'propiedades' => Propiedad::get(3),
			'inicio' => ' inicio'
		]);
	}

	public static function nosotros( Router $router ){
		$router->render('paginas/nosotros');
	}

	public static function propiedades( Router $router ){
		$error = isset($_GET['error']) ? (int)filter_var( $_GET['error'], FILTER_SANITIZE_NUMBER_INT)  : 0;
		$mensajeError = null;
		if($error){
            $mensajeError = s(Notification::errorNotification($error));
        }
		$router->render('paginas/propiedades', [
			'propiedades' => Propiedad::all(),
			'mensajeError' => $mensajeError
		]);
	}

	public static function propiedad( Router $router ){
		$propiedad = Propiedad::existsById($_GET['id'], '/propiedades');

		$router->render('paginas/propiedad', [
			'propiedad' => $propiedad
		]);
	}

	public static function blog( Router $router ){
		echo "Desde Blog";
	}

	public static function entrada( Router $router ){
		echo "Desde entrada";
	}

	public static function contactoGet( Router $router ){
		echo "Desde contactoGet";
	}

	public static function contactoPost( Router $router ){
		echo "Desde contactoPost";
	}
}