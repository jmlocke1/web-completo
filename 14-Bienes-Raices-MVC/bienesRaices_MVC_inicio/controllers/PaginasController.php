<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController {
	public static function index( Router $router ){
		
		$router->render('paginas/index', [
			'propiedades' => Propiedad::get(3),
			'inicio' => ' inicio'
		]);
	}

	public static function nosotros( Router $router ){
		echo "Desde Nosotros";
	}

	public static function propiedades( Router $router ){
		echo "Desde Propiedades";
	}

	public static function propiedad( Router $router ){
		echo "Desde propiedad";
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