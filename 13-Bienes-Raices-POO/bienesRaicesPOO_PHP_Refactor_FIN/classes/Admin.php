<?php

namespace App;

class Admin extends ActiveRecord {
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = "El Email del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM usuarios WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            return [
                true,
                $resultado
            ];
        } else {
            self::$errores[] = 'El Usuario No Existe';
            return [
                false,
                self::$errores
            ];
        } 
    }

    public function verificarPassword($resultado) {

        $usuario = $resultado->fetch_assoc();
        $auth = password_verify($this->password, $usuario['password']);


        if($auth) {

            // El usuario esta autenticado
            session_start();

            // Llenar el arreglo de la sesión
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['login'] = true;
            return true;
        } else {
            self::$errores[] = 'Password Incorrecto';
            return [
                false,
                self::$errores
            ];
        }


    }

}
