<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function loginGet(Router $router){
        $router->render('auth/login');
    }

    public static function loginPost(Router $router){
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

    public static function recuperarGet(Router $router){
        echo "Desde RecuperarGet";
    }

    public static function recuperarPost(Router $router){
        echo "Desde RecuperarPost";
    }

    public static function crearGet(Router $router){
        $usuario = new Usuario();
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario
        ]);
    }

    public static function crearPost(Router $router){
        $usuario = new Usuario;
        $usuario->sincronizar($_POST);
        $alertas = $usuario->validarNuevaCuenta();
        debuguear($alertas);
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario
        ]);
    }
}