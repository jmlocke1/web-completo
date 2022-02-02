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
        if(empty($alertas)){
            // Comprobar que exista el usuario
            $usuario = Usuario::where('email', $auth->email);
            
            if($usuario){
                // Verificar el password
                if($usuario->comprobarPasswordYVerificado($auth->password)){
                    $usuario->saveDataInSession();
                    
                    // Redireccionamiento
                    if($usuario->admin === '1'){
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        header('Location: /admin');
                    }else{
                        header('Location: /cita');
                    }
                }
            }else{
                Usuario::setAlerta('error', 'Usuario no encontrado');
            }
            $alertas = Usuario::getAlertas();
        }
        
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        echo "Desde logout";
    }

    public static function olvideGet(Router $router){
        
        $router->render('auth/olvide-password', [
            'alertas' => []
        ]);
    }

    public static function olvidePost(Router $router){
        $alertas = [];
        $auth = new Usuario($_POST);
        $alertas = $auth->validarEmail();
        if(empty($alertas)){
            $usuario = Usuario::where('email', $auth->email);

            if($usuario){
                $mensaje = 'El Usuario sí existe';
                if($usuario->confirmado === '1'){
                    $mensaje .= ' y está confirmado';
                    Usuario::setAlerta('exito', $mensaje);
                    // Generar un token
                    $usuario->crearToken();
                    $usuario->guardar();

                    // TODO: Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstruccionesRecuperacion();
                    // Alerta de éxito
                    Usuario::setAlerta('exito', 'Se ha mandado la información de recuperación a tu email. Revísalo y sigue las instrucciones');
                }else{
                    $mensaje .= ' pero no está confirmado. Revise su email donde encontrará instrucciones para confirmarlo';
                    Usuario::setAlerta('error', $mensaje);
                }
            }else{
                Usuario::setAlerta('error', 'El Usuario No existe');
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperarGet(Router $router){
        $usuario = Usuario::getUserByToken(s($_GET['token']));
        if($usuario){
            $error = false;
        }else{
            $error = true;
        }
        $router->render('auth/recuperar-password', [
            'alertas' => Usuario::getAlertas(),
            'error' => $error
        ]);
    }

    public static function recuperarPost(Router $router){
        $usuario = Usuario::getUserByToken(s($_GET['token']));
        if($usuario){
            $error = false;
        }else{
            $error = true;
        }
        $password = new Usuario($_POST);
        $alertas = $password->validarPassword();
        if(empty($alertas)){
            $usuario->password = $password->password;
            $usuario->hashPassword();
            $usuario->token = null;
            $resultado = $usuario->guardar();
            if($resultado){
                header('Location: /');
            }
        }
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
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

    /**
     * Confirma la cuenta creada.
     * 
     * @param Router $router
     * @return void
     */
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