<?php
namespace App;
class Vendedor extends ActiveRecord {
	const TABLENAME = "vendedores";
	protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

	public $id;
	public $nombre;
	public $apellido;
	public $telefono;

	public function __construct($args = [])
	{
		self::hayDB();
		
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->apellido = $args['apellido'] ?? '';
		$this->telefono = $args['telefono'] ?? '';
	}

	/**
	 * Valida los datos introducidos a la clase
	 */
	public function validar(){
		self::$errores = [];
		if(!$this->nombre) {
			self::$errores[] = "El nombre es obligatorio";
		}
		if(!$this->apellido) {
			self::$errores[] = "El apellido es obligatorio";
		}
		if(!$this->telefono) {
			self::$errores[] = "El teléfono es obligatorio";
		}
		if(!preg_match('/[0-9]{10}/', $this->telefono) || strlen($this->telefono) > 10){
			self::$errores[] = "Formato de teléfono no válido";
		}
		return self::$errores;
	}
}