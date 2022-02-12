<?php
namespace Model;

class CitaServicio extends ActiveRecord {
	protected static $tabla = 'citasservicios';
	protected static $columnasDB = ['citaid', 'servicioid'];

	public $citaid;
	public $servicioid;
	protected static $primaryKeys = ['citaid', 'servicioid'];
	/**
	 * Claves foráneas de la aplicación. la clave asociativa es la clave foránea
	 * y el valor es la tabla:
	 * $foreignKeys[foreignkey] = tablename
	 */
	protected static $foreignKeys = [
		'citaid' => 'citas',
		'servicioid' => 'servicios'
	];

	public function __construct($args = [])	{
		$this->citaid = $args['citaid'] ?? null;
		$this->servicioid = $args['servicioid'] ?? null;
	}

	/**
	 * Esta tabla no se actualiza, en todo caso se borra un registro y se crea otro nuevo
	 *
	 * @return void
	 */
	public function guardar() {
		return $this->crear();
	}

	public function validar(){
		self::$alertas['error'] = [];
		$validado = true;
		if(is_null($this->citaid) || !is_integer($this->citaid)){
			self::$alertas['error'][] = 'El campo cita es obligatorio y debe ser un entero';
			$validado = $validado && false;
		}
		if(is_null($this->servicioid) || !is_integer($this->servicioid)){
			self::$alertas['error'][] = 'El campo servicio es obligatorio y debe ser un entero';
			$validado = $validado && false;
		}
		if(!self::existeServicio($this->servicioid)){
			self::$alertas['error'][] = 'El servicio indicado no existe en la base de datos';
			$validado = $validado && false;
		}
		if(!self::existeCita($this->citaid)){
			self::$alertas['error'][] = 'La cita indicada no existe en la base de datos';
			$validado = $validado && false;
		}
		return $validado;
	}

	public static function existeServicio($id){
		$servicio = Servicio::find($id);
		return !is_null($servicio);
	}

	public static function existeCita($id){
		$cita = Cita::find($id);
		return !is_null($cita);
	}

	public static function find(array|int $ids){

	}

	// Prueba de inserción
	// $datos = [
	// 	'citaid' => 2,
	// 	'servicioid' => 5
	// ];
	// $citaServicio = new CitaServicio($datos);
	// $citaServicio->validar();
	// $resultado = $citaServicio->guardar();
	// debuguear($resultado);
}