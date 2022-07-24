<?php
namespace Controllers;

use Model\Proyecto;

class TareaController {
	public static function index() {

	}

	public static function crear() {
		iniciar_sesion();
		$proyectoId = $_POST['proyectoId'];
		$proyecto = Proyecto::where('url', $_POST['proyectoId']);
		if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
			$respuesta = [
				'tipo' => 'error',
				'mensaje' => 'Hubo un error al agregar la tarea'
			];
		}else{
			$respuesta = [
				'tipo' => 'exito',
				'mensaje' => 'Tarea agregada correctamente'
			];
		}
		echo json_encode($respuesta);
		return;
		$respuesta = [
			'proyectoId' => $proyectoId,
			'sesión' => $_SESSION,
			'proyectoPropio' => $_SESSION['id'] === $proyecto->propietarioId
		];
		
		echo json_encode($respuesta);
	}

	public static function actualizar() {
		
	}

	public static function eliminar() {
		
	}
}