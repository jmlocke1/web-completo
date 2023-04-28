<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
	public static function loginGet(Router $router) {
		

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión'
		]);
	}

	public static function loginPost(Router $router) {
		$alertas = [];
		$auth = new Usuario($_POST);
		$alertas = $auth->validarLogin();
		if(empty($alertas)){
			// Verificar que el usuario exista
			$usuario = Usuario::where('email', $auth->email);
			if(!$usuario || !$usuario->confirmado){
				Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
			}else{
				if($usuario->login($auth->password)){
					// Iniciar la sesión
					if(!isset($_SESSION)) {
						session_start();
					}
					$_SESSION['id'] = $usuario->id;
					$_SESSION['nombre'] = $usuario->nombre;
					$_SESSION['email'] = $usuario->email;
					$_SESSION['login'] = true;

					// Redireccionar
					header('Location: /dashboard');
				}
			}
		}
		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión',
			'alertas' => Usuario::getAlertas()
		]);
	}

	public static function logout(Router $router) {
		iniciar_sesion();
		$_SESSION = [];
		// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
		// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		// Finalmente, destruir la sesión.
		session_destroy();
		header('Location: /');
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
		if(empty($alertas)){
			$existeUsuario = $usuario->where('email', $usuario->email);
			if($existeUsuario){
				Usuario::setAlerta('error', 'El usuario ya existe');
				$alertas = Usuario::getAlertas();
			}else{
				// Crear un nuevo usuario
				// Hashear password
				$hash = $usuario->hashPassword();
				// Eliminar password2
				unset($usuario->password2);
				$usuario->crearToken();
				$resultado = $usuario->guardar();
				$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
				$email->enviarConfirmacion();
				if($resultado){
					header('Location: /mensaje');
				}
			}
		}
		
		$router->render('auth/crear', [
			'titulo' => 'Crea tu cuenta',
			'usuario' => $usuario,
			'alertas' => $alertas
		]);
	}

	public static function olvideGet(Router $router) {
		$router->render('auth/olvide', [
			'titulo' => 'Olvidé mi Password'
		]);
	}

	public static function olvidePost(Router $router) {
		$alertas = [];
		$usuario = new Usuario($_POST);
		$alertas = $usuario->validarEmail();
		if(empty($alertas)){
			$usuario = Usuario::where('email', $usuario->email);
			if($usuario && $usuario->confirmado){
				// Generar un nuevo token
				$usuario->crearToken();
				// Actualizar el usuario
				$usuario->guardar();
				// Enviar el email
				$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
				$email->enviarInstrucciones();
				// Imprimir la alerta
				Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
			}else{
				Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
				$alertas = Usuario::getAlertas();
			}
		}
		$router->render('auth/olvide', [
			'titulo' => 'Olvidé mi Password',
			'alertas' => Usuario::getAlertas()
		]);
	}

	public static function reestablecerGet(Router $router) {
		list($mostrar, $usuario) = self::reestablecerCommon();
		$router->render('auth/reestablecer', [
			'titulo' => 'Restablecer Password',
			'alertas' => Usuario::getAlertas(),
			'mostrar' => $mostrar
		]);
	}

	public static function reestablecerPost(Router $router) {
		list($mostrar, $usuario) = self::reestablecerCommon();
		$usuario->sincronizar($_POST);
		$alertas = $usuario->validarPassword();
		if(empty($alertas)){
			// Hashear password
			$hasheado = $usuario->hashPassword();
			// Eliminar el token
			$usuario->token = null;
			// Guardar el usuario en la BD
			if($hasheado){
				$resultado = $usuario->guardar();
				if($resultado){
					$usuario::setAlerta('exito', 'Password cambiado correctamente');
					$mostrar = false;
					// Redireccionar
					header('refresh:5;url= /');
				}else{
					$usuario::setAlerta('error', 'No se ha podido guardar el usuario');
				}
			}
			
		}
		$router->render('auth/reestablecer', [
			'titulo' => 'Restablecer Password',
			'alertas' => Usuario::getAlertas(),
			'mostrar' => $mostrar
		]);
	}

	private static function reestablecerCommon(){
		$token = s($_GET['token']);
		$mostrar = true;
		if(!$token) {
			header('Location: /');
			die();
		}
		// Identificar el usuario con este token
		$usuario = Usuario::where('token', $token);
		
		if(empty($usuario)){
			Usuario::setAlerta('error', 'Token no válido');
			$mostrar = false;
		}
		return [$mostrar, $usuario];
	}

	public static function mensaje(Router $router) {
		$router->render('auth/mensaje', [
			'titulo' => 'Cuenta creada con éxito'
		]);
	}

	public static function confirmar(Router $router) {
		$token = s($_GET['token']);
		if(!$token){
			header('Location: /');
			die();
		}
		// Encontrar al usuario con ese token
		$usuario = Usuario::where('token', $token);
		if(empty($usuario)){
			// No se encontró un usuario con ese token
			Usuario::setAlerta('error', 'Token no válido');
		}else{
			$usuario->confirmado = 1;
			$usuario->token = null;
			// Guardar en la BD
			$usuario->guardar();
			Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
		}
		
		$alertas = Usuario::getAlertas();
		$router->render('auth/confirmar', [
			'titulo' => 'Confirma tu cuenta UpTask',
			'alertas' => $alertas
		]);
	}
}