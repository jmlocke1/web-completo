<?php
namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
	public static function index() {
		$proyectoId = $_GET['id'];
		if(!$proyectoId){
			header('Location: /dashboard');
			return;
		} 
		$proyecto = Proyecto::where('url', $proyectoId);
		if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
			header('Location: /404');
			return;
		}
		$tareas = Tarea::belongsTo('proyectoId', $proyecto->id);
		echo json_encode(["tareas" =>$tareas]);
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
		$respuesta = [
			'tipo' => 'exito',
			'id' => $resultado['id'],
			'mensaje' => 'Tarea Creada Correctamente',
			'proyectoId' => $proyecto->id
		];
		echo json_encode($respuesta);
	}

	public static function actualizar() {
		echo json_encode($_POST);
	}

	public static function eliminar() {
		
	}
}