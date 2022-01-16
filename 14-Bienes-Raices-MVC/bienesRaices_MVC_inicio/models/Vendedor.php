<?php
namespace Model;
class Vendedor extends ActiveRecord {
	const TABLENAME = "vendedores";
	protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
	public static $notifications = [
		'createdSuccessfully' => Notification::SELLER_CREATED_SUCCESSFULLY,
		'removedSuccessfully' => Notification::SELLER_REMOVED_SUCCESSFULLY,
		'updatedSuccessfully' => Notification::SELLER_UPDATED_SUCCESSFULLY,
		'notExist' => Notification::SELLER_NOT_EXIST,
		'notCreated' => Notification::SELLER_COULD_NOT_BE_CREATED,
		'notDeleted' => Notification::SELLER_COULD_NOT_BE_DELETED,
		'notUpdated' => Notification::SELLER_COULD_NOT_BE_UPDATED,
		'idNotValid' => Notification::ID_NOT_VALID
	];
	/**
	 * Script de destino en caso de éxito
	 */
	protected static $destinationOnSuccess = '/admin';
	/**
	 * Script de destino en caso de error
	 */
	protected static $destinationOnError = '/admin';
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