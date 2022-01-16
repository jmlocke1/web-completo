<?php
namespace Controllers;

use Config;
use MVC\Router;
use Model\Propiedad;
use Model\Notification;
use Model\Vendedor;
use Model\Database\DB;

class PropiedadController {
    public static function index(Router $router){
        $datos = [
            'propiedades' => Propiedad::all(),
            'vendedores' => Vendedor::all()
        ];
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

    public static function crearGet(Router $router) {
        $router->render('propiedades/crear', [
            'propiedad' => new Propiedad(),
            'errores' => [],
            'vendedores' => Vendedor::all()
        ]);
    }

    public static function crearPost(Router $router){
        $propiedad = new Propiedad($_POST['propiedad']);
        $propiedad->setImagen($_FILES['propiedad']);
        $propiedad->validar();
        $errores = Propiedad::getErrors();
        // Revisar que el array de errores esté vacío
        if(empty($errores)){
            // Insertar en la base de datos
            $resultado = $propiedad->guardar();
            if($resultado){
                // Redireccionar al usuario
                header('Location: /admin?resultado='.Notification::AD_CREATED_SUCCESSFULLY);
                exit;
            }else{
                $errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => Vendedor::all()
        ]);
    }

    public static function actualizarGet(Router $router){
        $propiedad = Propiedad::existsById($_GET['propiedad']);
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => Propiedad::getErrors(),
            'vendedores' => Vendedor::all(),
            'imageFolder' => Config::CARPETA_IMAGENES_VIEW
        ]);
    }

    public static function actualizarPost(Router $router){
        $propiedad = Propiedad::existsById(($_GET['propiedad']));
        
        // Asignar los atributos
        $propiedad->sincronizar($_POST['propiedad']);
        $errores = $propiedad->validar();

        // Revisar que el array de errores esté vacío
        if(empty($errores)){
            $hayImagen = !empty($_FILES['propiedad']['name']['imagen']);
            if($hayImagen){
                $propiedad->setImagen($_FILES['propiedad']);                    
            }
            $resultado = $propiedad->guardar();
            if($resultado){
                // Redireccionar al usuario
                header('Location: /admin?resultado='.Notification::PROPERTY_UPDATED_SUCCESSFULLY);
                exit;
            }else{
                $errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
            }
            
        }


        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => Vendedor::all(),
            'imageFolder' => Config::CARPETA_IMAGENES_VIEW
        ]);
    }

    public static function eliminar(){
        $propiedad = Propiedad::existsById($_POST['id']);
        $resultado = $propiedad->eliminar();
        if($resultado){
            header('location: /admin?resultado='.Notification::PROPERTY_REMOVED_SUCCESSFULLY);
        }else{
            header('location: /admin?error='.Notification::PROPERTY_COULD_NOT_BE_REMOVED);
        }
    }
}