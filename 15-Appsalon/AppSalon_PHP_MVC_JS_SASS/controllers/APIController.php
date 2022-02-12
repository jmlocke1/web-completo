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
		// Almacena la cita y devuelve el id
		// $cita = new Cita($_POST);
		// $resultado = $cita->guardar();

		// Almacena la cita y el servicio
		$idServicios = explode(',', $_POST['servicios']);
		$resultado['servicios'] = $_POST['servicios'];
		echo json_encode($resultado);
	}
}