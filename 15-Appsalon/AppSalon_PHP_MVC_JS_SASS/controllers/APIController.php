<?php
namespace Controllers;

use Model\Cita;
use Model\Database\DB;
use Model\Servicio;

class APIController {
	public static function index(){
		$servicios = Servicio::all();
		echo(json_encode($servicios));
	}

	public static function guardar(){
		$cita = new Cita($_POST);
		$resultado = $cita->guardar();

		$respuesta = [
			'cita' => $cita,
			'resultado' => $resultado,
			'error' => array_shift( DB::getErrors() )
		];

		echo json_encode($respuesta);
	}
}