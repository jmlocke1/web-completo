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
}