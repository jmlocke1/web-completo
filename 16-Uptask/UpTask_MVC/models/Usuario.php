<?php
namespace Model;

class Usuario extends ActiveRecord {
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

	public $id;
	public $nombre;
	public $email;
	public $password;
	public $password2;
	public $token;
	public $confirmado;
	
	public function __construct($args = [])
	{
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? null;
		$this->email = $args['email'] ?? null;
		$this->password = $args['password'] ?? null;
		$this->password2 = $args['password2'] ?? null;
		$this->token = $args['token'] ?? null;
		$this->confirmado = $args['confirmado'] ?? 0;
	}

	public function validarLogin(){
		$this->validarEmail();
		if(!$this->password) {
			self::$alertas['error'][] = 'El Password no puede ir vacío';
		}
		return self::$alertas;
	}

	public function validarNuevaCuenta() {
		if(!$this->nombre) {
			self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
		}
		self::validarEmail();
		self::validarPassword();

		return self::$alertas;
	}

	public function validarPassword(){
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

	public function validar_perfil() {
		if(!$this->nombre) {
			self::setAlerta('error', 'El nombre es obligatorio');
		}
		return self::validarEmail();
	}

	public function hashPassword($nuevoPassword = null) {
		if(!$nuevoPassword) $nuevoPassword = $this->password;
		$password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
		if($password){
			$this->password = $password;
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Función que permite cambiar el password, validando el nuevo password
	 *
	 * @param string $password_actual
	 * @param string $password_nuevo
	 * @return boolean
	 */
	public function nuevo_password(string $password_actual, string $password_nuevo): bool {
		if(!$password_actual){
			self::setAlerta('error', 'El Password Actual no puede ir vacío');
		}
		if(!$password_nuevo){
			self::setAlerta('error', 'El Password Nuevo no puede ir vacío');
		}
		if(strlen($password_nuevo) < 6) {
			self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
		}
		if($this->login($password_actual) && empty(self::$alertas)){
			return $this->hashPassword($password_nuevo);
		}else{
			return false;
		}
	}

	public function login(string $password): bool {
		$ok = password_verify($password, $this->password);
		if(!$ok){
			self::setAlerta('error', 'Password Incorrecto');
		}
		return $ok;
	}

	public function crearToken(){
		$this->token = uniqid();
	}

	public function validarEmail() {
		if(!$this->email){
			self::$alertas['error'][] = "El Email es Obligatorio";
		}
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			self::$alertas['error'][] = "Email no Válido";
		}
		return self::$alertas;
	}
}