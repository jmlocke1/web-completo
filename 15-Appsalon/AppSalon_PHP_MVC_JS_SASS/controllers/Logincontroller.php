<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;
use MVC\Utilities\Email;

class LoginController {
    public static function loginGet(Router $router){
        $router->render('auth/login', [
            'alertas' => []
        ]);
    }

    public static function loginPost(Router $router){
        $alertas = [];
        $auth = new Usuario($_POST);
        $alertas = $auth->validarLogin();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
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
                $email->enviarConfirmacion();

                // Crear el usuario
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /mensaje');
                }
                
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no válido');
        }else{
            echo "Token válido, confirmando usuario...";
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}