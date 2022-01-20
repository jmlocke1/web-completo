<?php
namespace Controllers;

use Model\Admin;
use MVC\Router;
class LoginController {
    public static function loginGet(Router $router){
        $router->render('auth/login', [
            'errores' => []
        ]);
    }

    public static function loginPost(Router $router){
        $login = new Admin($_POST);
        
        $errores = $login->validar();
        if(empty($errores)){
            // Verificar si el usuario existe
            if( !($user = $login->existeUsuario()) ){
                $errores = $login->getErrors();
            }else{
                // Verificar el password
                $auth = $login->comprobarPassword($user->password);
                debuguear($auth);
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