<?php
namespace Model;

class Usuario extends ActiveRecord {
    const TABLENAME = 'usuarios';
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

    public function validar(){
        if(!$this->email){
            self::$errores[] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM ". self::TABLENAME." WHERE email='{$this->email}' LIMIT 1";
        
        $resultado = self::consultarSQL($query);
        if(empty($resultado)){
            self::$errores[] = "No existe el usuario";
            return false;
        }else{
            return array_shift($resultado);
        }
    }

    public function comprobarPassword($password){
        $auth = password_verify($this->password, $password);
        if(!$auth){
            self::$errores[] = 'El Password es incorrecto';
        }
        return $auth;
    }

    public function autenticar(){
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}