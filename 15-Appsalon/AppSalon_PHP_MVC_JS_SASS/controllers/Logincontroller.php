<?php
namespace Controllers;

use MVC\Router;

class LoginController {
    public static function loginGet(Router $router){
        $router->render('auth/login');
    }

    public static function loginPost(){
        echo "Desde loginPost";
    }

    public static function logout(){
        echo "Desde logout";
    }

    public static function olvideGet(Router $router){
        $router->render('auth/olvide-password', [
            
        ]);
    }

    public static function olvidePost(Router $router){
        echo "Desde olvidePost";
    }

    public static function recuperarGet(){
        echo "Desde RecuperarGet";
    }

    public static function recuperarPost(){
        echo "Desde RecuperarPost";
    }

    public static function crearGet(Router $router){
        $router->render('auth/crear-cuenta', [

        ]);
    }

    public static function crearPost(){
        echo "Desde crearCuentaPost";
    }
}