<?php
namespace Model;

use Model\Database\DB;
use MVC\Utilities\Password;

class Usuario extends ActiveRecord {
	// Base de datos
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

	public $id;
	public $nombre;
	public $apellido;
	public $email;
	public $password;
	public $telefono;
	public $admin;
	public $confirmado;
	public $token;
	
	public function __construct($args = [])	{
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->apellido = $args['apellido'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->password = $args['password'] ?? '';
		$this->telefono = $args['telefono'] ?? '';
		$this->admin = $args['admin'] ?? '0';
		$this->confirmado = $args['confirmado'] ?? '0';
		$this->token = $args['token'] ?? '';
	}

	public function validarNuevaCuenta(){
		self::$alertas = [];
		if(!$this->nombre){
			self::$alertas['error'][] = 'El nombre es obligatorio';
		}
		if(!$this->apellido){
			self::$alertas['error'][] = 'El apellido es obligatorio';
		}
		if(!$this->email){
			self::$alertas['error'][] = 'El Email es obligatorio';
		}
		if(!$this->password){
			self::$alertas['error'][] = 'El Password es obligatorio';
		}
		if(strlen($this->password) < \Config::MIN_LENGTH_PASSWORD){
			self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
		}

		return self::$alertas;
	}

	public function validarLogin(){
		if(!$this->email){
			self::$alertas['error'][] = 'El email es obligatorio';
		}
		if(!$this->password){
			self::$alertas['error'][] = "El Password es obligatorio";
		}

		return self::$alertas;
	}

	/**
	 * Revisa si el usuario existe
	 */
	public function existeUsuario() {
		$query = " SELECT * FROM ".self::$tabla." WHERE email = '{$this->email}' LIMIT 1";
		$resultado = DB::getQueryArray($query);
		$existe = !empty($resultado);
		if($existe){
			self::$alertas['error'][] = 'El Usuario ya está registrado';
		}
		return $existe;
	}

	public function hashPassword(){
		$this->password = Password::hash($this->password);
	}

	public function crearToken() {
		$this->token = uniqid();
	}
}