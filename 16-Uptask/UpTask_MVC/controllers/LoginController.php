<?php

namespace Controllers;

use Model\Usuario;
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
		$usuario = new Usuario();

		$router->render('auth/crear', [
			'titulo' => 'Crea tu cuenta',
			'usuario' => $usuario
		]);
	}

	public static function crearPost(Router $router) {
		$usuario = new Usuario;
		$usuario->sincronizar($_POST);
		$alertas = $usuario->validarNuevaCuenta();
		$router->render('auth/crear', [
			'titulo' => 'Crea tu cuenta',
			'usuario' => $usuario,
			'alertas' => $alertas
		]);
	}

	public static function olvideGet(Router $router) {
		$router->render('auth/olvide', [
			'titulo' => 'Olvidé Password'
		]);
	}

	public static function olvidePost(Router $router) {
		echo 'Desde Olvidé Post';
	}

	public static function reestablecerGet(Router $router) {
		$router->render('auth/reestablecer', [
			'titulo' => 'Restablecer Password'
		]);
	}

	public static function reestablecerPost(Router $router) {
		echo 'Desde Reestablecer Post';
	}

	public static function mensaje(Router $router) {
		$router->render('auth/mensaje', [
			'titulo' => 'Cuenta creada con éxito'
		]);
	}

	public static function confirmar(Router $router) {
		$router->render('auth/confirmar', [
			'titulo' => 'Confirma tu cuenta UpTask'
		]);
	}
}