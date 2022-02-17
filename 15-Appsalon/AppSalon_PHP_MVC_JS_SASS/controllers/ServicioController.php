<?php
namespace Controllers;

use MVC\Router;

class ServicioController {
    public static function index(Router $router){
        iniciaSesión();
        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function crearGet(Router $router) {
        iniciaSesión();
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function crearPost(Router $router) {
        iniciaSesión();
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function actualizarGet(Router $router) {
        iniciaSesión();
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function actualizarPost(Router $router) {
        iniciaSesión();
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function eliminar(Router $router) {
        echo "Desde Eliminar servicio";
    }
}