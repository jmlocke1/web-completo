<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;
class LoginController {
    public static function loginGet(Router $router){
        $router->render('auth/login', [
            'errores' => []
        ]);
    }

    public static function loginPost(Router $router){
        $login = new Usuario($_POST);
        
        $errores = $login->validar();
        if(empty($errores)){
            // Verificar si el usuario existe
            if( !($user = $login->existeUsuario()) ){
                $errores = $login->getErrors();
            }else{
                // Verificar el password
                $auth = $login->comprobarPassword($user->password);
                if($auth){
                    // Autenticar al usuario
                    $login->autenticar();
                }else{
                    $errores = $login->getErrors();
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(){
        echo "Desde Logout";
    }
}