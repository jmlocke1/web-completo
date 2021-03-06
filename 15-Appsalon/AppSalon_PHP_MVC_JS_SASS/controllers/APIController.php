<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Database\DB;
use Model\Servicio;

class APIController {
	public static function index(){
		$servicios = Servicio::all();
		echo(json_encode($servicios));
	}

	public static function guardar(){
		// Almacena la cita y devuelve el id
		$cita = new Cita($_POST);
		$resultado = $cita->crear();
		if($resultado['resultado']){
			$citaid = $resultado['id'];
		}else{
			echo json_encode($resultado);
			return;
		}
		

		// Almacena la cita y el servicio
		$idServicios = explode(',', $_POST['servicios']);
		foreach($idServicios as $idServicio){
			$args = [
				'citaid' => $citaid,
				'servicioid' => intval($idServicio)
			];
			$citaServicio = new CitaServicio($args);
			$valido = $citaServicio->validar();
			if($valido){
				$resultado['servicios'][] = $citaServicio->guardar();
			}else{
				//$errorValidate = $citaServicio::getAlertas();
				//$resultado['servicios']['errores'] = array_merge($resultado['servicios']['errores'], $errorValidate);
				$resultado['servicios']['errores'] = $citaServicio::getAlertas();
			}
		}
		echo json_encode($resultado);
	}

	public static function eliminar(){
		$id = $_POST['id'];
		$cita = Cita::find($id);
		$cita->eliminar();
		header('Location: '. $_SERVER['HTTP_REFERER']);
	}
}