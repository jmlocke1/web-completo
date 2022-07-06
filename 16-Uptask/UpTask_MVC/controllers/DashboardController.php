<?php
namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController {
	public static function index(Router $router){
		iniciar_sesion();
		isAuth();
		$proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['id']);
		$router->render('dashboard/index', [
			'titulo' => 'Proyectos',
			'proyectos' => $proyectos
		]);
	}

	public static function crear_proyecto(Router $router){
		iniciar_sesion();
		isAuth();
		$alertas = [];
		$router->render('dashboard/crear-proyecto', [
			'titulo' => 'Crear Proyecto',
			'alertas' => $alertas
		]);
	}

	public static function crear_proyecto_post(Router $router){
		iniciar_sesion();
		isAuth();
		$alertas = [];
		$proyecto = new Proyecto($_POST);
		// Validación
		$alertas = $proyecto->validarProyecto();
		if(empty($alertas)){
			// Asignarle un dueño de proyecto
			$proyecto->propietarioId = (int) $_SESSION['id'];
			// Generar una url única
			$proyecto->setURL();
			
			// Guardar el proyecto
			$resultado = $proyecto->guardar();
			if($resultado){
				header('Location: /proyecto?id=' . $proyecto->url);
			}else{
				$proyecto::setAlerta('error', 'No se pudo guardar el proyecto '. $proyecto->proyecto);
			}
		}
		$router->render('dashboard/crear-proyecto', [
			'titulo' => 'Crear Proyecto',
			'alertas' => $alertas
		]);
	}

	public static function proyecto(Router $router){
		iniciar_sesion();
		isAuth();
		$alertas = [];
		// Revisar que la persona que visita el proyecto es quien lo creó
		$url = s($_GET['id']);
		if(!$url) header('Location: /dashboard');
		$proyecto = Proyecto::where('url', $url);
		if($proyecto->propietarioId !== $_SESSION['id']){
			header('Location: /dashboard');
		}
		$router->render('dashboard/proyecto', [
			'titulo' => $proyecto->proyecto,
			'alertas' => $alertas
		]);
	}

	public static function perfil(Router $router){
		iniciar_sesion();
		isAuth();
		$router->render('dashboard/perfil', [
			'titulo' => 'Perfil'
		]);
	}
}