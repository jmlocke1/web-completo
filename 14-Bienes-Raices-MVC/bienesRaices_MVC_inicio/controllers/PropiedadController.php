<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Notification;
use Model\Vendedor;

class PropiedadController {
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $datos = ["propiedades" => $propiedades];
        // Muestra mensaje condicional
        $resultado = isset($_GET['resultado']) ? (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT)  : 0;
        $error = isset($_GET['error']) ? (int)filter_var( $_GET['error'], FILTER_SANITIZE_NUMBER_INT)  : 0;
        if($resultado){
            $datos['mensajeExito'] = s(Notification::successNotification($resultado));
        }
        if($error){
            $datos['mensajeError'] = s(Notification::errorNotification($error));
        }
        
        $router->render('propiedades/admin', $datos);
    }

    public static function crear(Router $router) {
        $datos = [];
        $datos['propiedad'] = new Propiedad;
        $datos['vendedores'] = Vendedor::all();
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            debuguear($_POST);
        }
        $router->render('propiedades/crear', $datos);
    }

    public static function actualizar(Router $router){
        echo "Actualizar propiedad";
    }
}