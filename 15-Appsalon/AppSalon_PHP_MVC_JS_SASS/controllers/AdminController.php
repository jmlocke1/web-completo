<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class Admincontroller {
	public static function index( Router $router ){
		iniciaSesión();
		
		isAdmin();
		if(validarFecha($_GET['fecha-desde'] ?? '')){
			$fecha = $_GET['fecha-desde'];
		}else{
			$fecha = date('Y-m-d');
		}
		if(validarFecha($_GET['fecha-hasta'] ?? '')){
			$fechaHasta = $_GET['fecha-hasta'];
		}else{
			$fechaHasta = $fecha;
		}
		
		$citas = AdminCita::getCitas($fecha, $fechaHasta);
		
		$router->render('admin/index', [
			'nombre' => $_SESSION['nombre'],
			'citas' => $citas,
			'fecha' => $fecha,
			'fechaHasta' => $fechaHasta
		]);
	}
}