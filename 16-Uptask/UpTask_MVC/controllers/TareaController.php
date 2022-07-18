<?php
namespace Controllers;

class TareaController {
	public static function index() {

	}

	public static function crear() {
		$array = [
			'respuesta' => true,
			'nombre' => 'Jose',
			'metodo' => $_SERVER['REQUEST_METHOD'],
			'post' => $_POST
		];
		echo json_encode($array);
	}

	public static function actualizar() {
		
	}

	public static function eliminar() {
		
	}
}