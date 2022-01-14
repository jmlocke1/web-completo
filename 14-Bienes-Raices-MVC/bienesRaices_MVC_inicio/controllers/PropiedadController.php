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
        $id = validarORedireccionar('/admin', 'propiedad');
        $propiedad = Propiedad::find(($id));
        // Comprobamos si existe la propiedad
        if(is_null($propiedad)){
            header('Location: /admin?error='.Notification::PROPERTY_NOT_EXIST);
            exit;
        }
        
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => Propiedad::getErrors(),
            'vendedores' => Vendedor::all(),
            'imageFolder' => Config::CARPETA_IMAGENES_VIEW
        ]);
    }

    public static function actualizarPost(Router $router){
        $id = validarORedireccionar('/admin', 'propiedad');
        $propiedad = Propiedad::find(($id));
        // Comprobamos si existe la propiedad
        if(is_null($propiedad)){
            header('Location: /admin?error='.Notification::PROPERTY_NOT_EXIST);
            exit;
        }
        // Asignar los atributos
        $args = $_POST['propiedad'];
            
        $propiedad->sincronizar($args);
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

    public static function eliminar(Router $router){
        $propiedad = existsProperty('/admin');
        $resultado = $propiedad->eliminar();
        if($resultado){
            header('location: /admin?resultado='.Notification::PROPERTY_REMOVED_SUCCESSFULLY);
        }else{
            header('location: /admin?error='.Notification::PROPERTY_COULD_NOT_BE_REMOVED);
        }
    }

    public static function eliminarGet(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            echo "Estamos en eliminar en get";
        }else{
            echo "No sé donde estoy desde get";
        }
    }
}