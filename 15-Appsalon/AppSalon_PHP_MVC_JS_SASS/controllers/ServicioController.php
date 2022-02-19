<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;
use MVC\Utilities\Alertas;

class ServicioController {
    public static function index(Router $router){
        iniciaSesión();
        $alertas = Alertas::getAlertsFromArray($_GET);
        $servicios = Servicio::all();
        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'alertas' => $alertas
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
            header('Location: /servicios?exito='.Alertas::SERVICE_CREATED_SUCCESSFULLY);
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
            header('Location: /servicios?exito='.Alertas::SERVICE_UPDATED_SUCCESSFULLY);
        }
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    private static function actualizarComun(){
        iniciaSesión();
        $alertas = Alertas::getAlertsFromArray($_GET);
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
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: /servicios?error='.Alertas::ID_NOT_VALID);
        }
        $servicio = Servicio::find($id);
        if(is_null($servicio)) {
            header('Location: /servicios?error='.Alertas::SERVICE_NOT_EXIST);
        }else{
            $resultado = $servicio->eliminar();
            if($resultado){
                header('Location: /servicios?exito='.Alertas::SERVICE_REMOVED_SUCCESSFULLY);
            }else{
                header('Location: /servicios?error='.Alertas::SERVICE_COULD_NOT_BE_REMOVED);
            }
        }
    }
}