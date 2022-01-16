<?php
namespace Controllers;

use Config;
use MVC\Router;
use Model\Propiedad;
use Model\Notification;
use Model\Vendedor;
use Model\Database\DB;

class VendedorController {

	public static function crearGet(Router $router){
		$router->render('vendedores/crear', [
            'vendedor' => new Vendedor(),
            'errores' => []
        ]);
	}

	public static function crearPost(Router $router){
		// Crear una nueva instancia
		$vendedor = new Vendedor($_POST['vendedor']);
		// Validar que no haya campos vacíos
		$errores = $vendedor->validar();
		if(empty($errores)){
			$resultado = $vendedor->guardar();
			if($resultado){
				// Redireccionar al usuario
				header('Location: /admin?resultado='.Notification::SELLER_CREATED_SUCCESSFULLY);
			}else{
				$errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
			}
		}
		$router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
	}

	public static function actualizarGet(Router $router){
		// Validar la url por id válido
		$vendedor = Vendedor::existsById($_GET['vendedor']);
		// Comprobamos si existe el vendedor
		if(is_null($vendedor)){
			header('Location: /admin?error='.Notification::SELLER_NOT_EXIST);
		}

		// Array con mensajes de errores
		$errores = Vendedor::getErrors();
		$router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => Vendedor::getErrors()
        ]);
	}

	public static function actualizarPost(Router $router){
		// Validar la url por id válido
		$vendedor = Vendedor::existsById($_GET['vendedor']);
		// Asignar los valores
		$vendedor->sincronizar($_POST['vendedor']);
		// Validación
		$errores = $vendedor->validar();
		if(empty($errores)){
			$resultado = $vendedor->guardar();
			if($resultado){
				// Redireccionar al usuario
				header('Location: /admin?resultado='.Vendedor::$notifications['updatedSuccessfully']);
				exit;
			}else{
				$errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
			}
		}
		$router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
	}

	public static function eliminar(){
		$vendedor = Vendedor::existsById($_POST['id']);
		$resultado = $vendedor->eliminar();
		if($resultado){
			header('location: /admin?resultado='.Vendedor::$notifications['removedSuccessfully']);
		}else{
			$_SESSION['error'] = DB::getDB()->error;
			header('location: /admin?error='.Vendedor::$notifications['notDeleted']);
		}
	}
}