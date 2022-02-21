<?php

namespace Controllers;

use MVC\Router;

class LoginController {
	public static function loginGet(Router $router) {
		

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión'
		]);
	}

	public static function loginPost(Router $router) {

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión'
		]);
	}

	public static function logout(Router $router) {
		echo "Desde Logout";
	}

	public static function crearGet(Router $router) {
		

		$router->render('auth/crear', [
			'titulo' => 'Crea tu cuenta'
		]);
	}

	public static function crearPost(Router $router) {
		echo 'Desde Crear Post';
	}

	public static function olvideGet(Router $router) {
		echo "Desde Olvidé Get";
	}

	public static function olvidePost(Router $router) {
		echo 'Desde Olvidé Post';
	}

	public static function reestablecerGet(Router $router) {
		echo "Desde Reestablecer Get";
	}

	public static function reestablecerPost(Router $router) {
		echo 'Desde Reestablecer Post';
	}

	public static function mensaje(Router $router) {
		echo 'Desde Mensaje';
	}

	public static function confirmar(Router $router) {
		echo 'Desde Confirmar';
	}
}