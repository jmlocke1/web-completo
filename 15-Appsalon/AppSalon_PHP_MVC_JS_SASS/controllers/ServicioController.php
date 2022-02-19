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
        [$alertas, $servicio] = self::actualizarComun();
        
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizarPost(Router $router) {
        [$alertas, $servicio] = self::actualizarComun();
        $servicio->sincronizar($_POST);
        $alertas = $servicio->validar();
        if(empty($alertas)){
            $servicio->guardar();
            header('Location: /servicios');
        }
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    private static function actualizarComun(){
        iniciaSesión();
        $alertas = [];
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        //debuguear($id);
        if(!$id){
            $servicio = null;
        }else{
            $servicio = Servicio::find($id);
        }
        if(!isset($servicio)){
            $alertas['error'][] = 'El servicio solicitado no existe';
            $servicio = new Servicio();
        }
        return [$alertas, $servicio];
    }

    public static function eliminar(Router $router) {
        echo "Desde Eliminar servicio";
    }
}