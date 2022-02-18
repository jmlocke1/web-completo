<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index(Router $router){
        iniciaSesión();
        $servicios = Servicio::all();
        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crearGet(Router $router) {
        iniciaSesión();
        $servicio = new Servicio();
        $alertas = [];
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function crearPost(Router $router) {
        iniciaSesión();
        $alertas = [];
        $servicio = new Servicio();
        $servicio->sincronizar($_POST);
        $alertas = $servicio->validar();
        if(empty($alertas)){
            $servicio->guardar();
            header('Location: /servicios');
        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizarGet(Router $router) {
        iniciaSesión();
        $alertas = [];
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'alertas' => $alertas
        ]);
    }

    public static function actualizarPost(Router $router) {
        iniciaSesión();
        $alertas = [];
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(Router $router) {
        echo "Desde Eliminar servicio";
    }
}