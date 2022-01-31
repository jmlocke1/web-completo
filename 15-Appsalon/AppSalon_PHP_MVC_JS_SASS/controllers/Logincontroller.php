<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;
use MVC\Utilities\Email;

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
            'usuario' => $usuario,
            'alertas' => []
        ]);
    }

    public static function crearPost(Router $router){
        $usuario = new Usuario;
        $usuario->sincronizar($_POST);
        $alertas = $usuario->validarNuevaCuenta();
        
        // Revisar que alerta esté vacío
        if(empty($alertas)){
            // Verificar que el usuario no esté registrado
            if($usuario->existeUsuario()) {
                $alertas = Usuario::getAlertas();
            }else{
                // Hashear el Password
                $usuario->hashPassword();

                // Generar un token único
                $usuario->crearToken();

                // Enviar el email

                $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                debuguear($email);
                debuguear($usuario);
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}