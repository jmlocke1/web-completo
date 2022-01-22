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
        if(!isset($_SESSION)) {
            session_start();
        }
        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        header('Location: /');
    }
}