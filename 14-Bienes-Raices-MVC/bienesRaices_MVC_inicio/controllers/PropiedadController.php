<?php
namespace Controllers;
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

    public static function crear(Router $router) {
        $datos = [];
        $datos['propiedad'] = new Propiedad;
        $datos['vendedores'] = Vendedor::all();
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
            
            !empty($_FILES['propiedad']['tmp_name']['imagen']) ? $propiedad->setImagen($_FILES['propiedad']) : '';
            

            $propiedad->validar();
            $datos['errores'] = Propiedad::getErrors();
            
            // Revisar que el array de errores esté vacío
            if(empty($datos['errores'])){
                // Insertar en la base de datos
                $resultado = $propiedad->guardar();
                if($resultado){
                    // Redireccionar al usuario
                    header('Location: /admin?resultado='.Notification::AD_CREATED_SUCCESSFULLY);
                }else{
                    $datos['errores'][] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
                }
            }
            
 
        }
        $router->render('propiedades/crear', $datos);
    }

    public static function actualizar(Router $router){
        echo "Actualizar propiedad";
    }
}