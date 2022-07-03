<?php
namespace Model;

class Usuario extends ActiveRecord {
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

	public function __construct($args = [])
	{
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? null;
		$this->email = $args['email'] ?? null;
		$this->password = $args['password'] ?? null;
		$this->password2 = $args['password2'] ?? null;
		$this->token = $args['token'] ?? null;
		$this->confirmado = $args['confirmado'] ?? null;
	}

	public function validarNuevaCuenta() {
		if(!$this->nombre) {
			self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
		}
		if(!$this->email) {
			self::$alertas['error'][] = 'El email del usuario es obligatorio';
		}
		if(!$this->password) {
			self::$alertas['error'][] = 'El Password no puede ir vacío';
		}
		if(strlen($this->password) < 6) {
			self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
		}
		if($this->password !== $this->password2) {
			self::$alertas['error'][] = 'Los Password son diferentes';
		}

		return self::$alertas;
	}

	public function hashPassword() {
		$password = password_hash($this->password, PASSWORD_DEFAULT);
		if($password){
			$this->password = $password;
			return true;
		}else{
			return false;
		}
	}

	public function crearToken(){
		$this->token = uniqid();
	}
}