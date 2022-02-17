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

	public function validarEmail(){
		if(!$this->email){
			self::$alertas['error'][] = 'El email es obligatorio';
		}
		return self::$alertas;
	}

	public function validarPassword() {
		if(!$this->password) {
			self::setAlerta('error', 'El Password es obligatorio');
		}
		if(strlen($this->password)  < 6) {
			self::setAlerta('error', 'El Password debe tener al menos 6 caracteres');
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

	public static function getUserByToken($token) {
        // Buscar usuario por su token
        $usuario = self::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            return false;
        }else{
            return $usuario;
        }
    }

	public function hashPassword(){
		$this->password = Password::hash($this->password);
	}

	public function crearToken() {
		$this->token = uniqid();
	}

	public function comprobarPasswordYVerificado(string $password){
		if(!$this->confirmado){
			self::setAlerta('error', 'El usuario no está aún confirmado');
			return false;
		}
		$passCorrect = Password::verify($password, $this->password);
		if($passCorrect){
			self::setAlerta('exito', 'El Password es correcto');
			$this->needsRehash($password);
			return true;
		}else{
			self::setAlerta('error', 'El Password no es correcto');
			return false;
		}
	}

	/**
	 * Guarda los datos del usuario en la sesión actual
	 */
	public function saveDataInSession(){
		iniciaSesión();
		$_SESSION['id'] = $this->id;
		$_SESSION['nombre'] = $this->nombre . " " . $this->apellido;
		$_SESSION['email'] = $this->email;
		$_SESSION['login'] = true;
		$_SESSION['id'] = $this->id;
	}

	/**
	 * Comprueba si el password necesita ser hasheado de nuevo.
	 * Esto puede ocurrir si cambia el algoritmo de hash por defecto
	 * de PHP.
	 */
	private function needsRehash(string $password){
		$rehash = Password::needsRehash($password, $this->password);
		if($rehash){
			$this->password = $rehash;
			if($this->guardar()){
				self::setAlerta('exito', 'El Password ha sido hasheado de nuevo para cumplir con los estándares de seguridad actuales');
			}else{
				self::setAlerta('error', 'El Password debe ser hasheado de nuevo para cumplir con los estándares de seguridad actuales, pero no se ha podido guardar el objeto. ');
				self::addAlertasError(DB::getErrors());
			}
		}
	}
}