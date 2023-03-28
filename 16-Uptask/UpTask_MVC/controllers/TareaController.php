<?php
namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
	public static function index() {

	}

	public static function crear() {
		iniciar_sesion();
		$proyecto = Proyecto::where('url', $_POST['proyectoId']);
		if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
			$respuesta = [
				'tipo' => 'error',
				'mensaje' => 'Hubo un error al agregar la tarea'
			];
			echo json_encode($respuesta);
			return;
		}
		// Todo bien, instanciar y crear la tarea
		$datos = [
			'nombre' => $_POST['nombre'],
			'proyectoId' => $proyecto->id
		];
		$tarea = new Tarea($datos);
		$resultado = $tarea->guardar();
		echo json_encode($resultado);
	}

	public static function actualizar() {
		
	}

	public static function eliminar() {
		
	}
}