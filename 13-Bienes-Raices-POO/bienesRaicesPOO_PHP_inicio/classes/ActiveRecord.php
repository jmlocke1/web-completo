<?php
namespace App;
use App\Database\DB;

class ActiveRecord {
	protected static $db;
	protected static $errores = [];


	/**
	 * Lista todos los registros
	 */
	public static function all(){
		$query = "SELECT * FROM ".get_called_class()::TABLENAME;
		$resultado = self::consultarSQL($query);
		return $resultado;
	}

	/**
	 * Busca un registro por su id
	 */
	public static function find($id){
		$query = "SELECT * FROM ".get_called_class()::TABLENAME." WHERE id='$id'";
		$result = self::consultarSQL($query);
		return array_shift($result);
	}

	/**
	 * Devuelve los errores al insertar datos
	 */
	public static function getErrors(){
		return self::$errores;
	}

	/**
	 * Comprueba si tenemos conexión a la base de datos, de lo contrario obtiene una
	 */
	protected static function hayDB(){
		if(!isset(self::$db)){
			self::$db = DB::getDB();
		}
	}

	protected static function consultarSQL($query){
		
		// Consultar la base de datos
		self::hayDB();
		$resultado = self::$db->query($query);
		// Iterar los resultados
		$array = [];
		while($registro = $resultado->fetch_assoc()){
			$array[] = self::crearObjeto($registro);
		}

		// Liberar la memoria
		$resultado->free();
		// Retornar los resultados
		return $array;
	}

	protected static function crearObjeto($registro){
		// Crear un objeto de la clase hija
		$nombreClase =  get_called_class();
		$objeto = new $nombreClase;
		
		foreach($registro as $key => $value){
			if(property_exists( $objeto, $key )){
				$objeto->$key = $value;
			}
		}
		return $objeto;
	}

	/**
	 * Identifico y uno los atributos de la BD
	 */
	public function atributos(): array{
		$atributos = [];
		// Obtenemos las columnas de la tabla de la clase llamante
		$columnasDB = get_called_class()::$columnasDB;
		foreach($columnasDB as $columna){
			$atributos[$columna] = $this->$columna;
		}
		return $atributos;
	}

	public function guardar() {
		// Sanitizar los datos
		$atributos = $this->sanitizarAtributos();
		
		$query = " INSERT INTO ".get_called_class()::TABLENAME." ( ";
		$query .= join(", ", array_keys($atributos));
		$query .= " ) ";
    	$query .= " VALUES ( '";
		$query .= join("', '", array_values($atributos));
		$query .= "' )";
		
		return DB::insert($query);
	}

	/**
	 * Sincroniza el objeto en memoria con los cambios realizados por el usuario
	 */
	public function sincronizar( $args = [] ){
		
		foreach($args as $key => $value){
			if($key == "id") continue;
			
			if(property_exists($this, $key) && !is_null($value)){
				$this->$key = $value;
			}
		}
	}

	public function sanitizarAtributos(){
		$atributos = $this->atributos();
		$sanitizado = [];
		foreach($atributos as $key => $value){
			if($key == 'id') continue;
			$sanitizado[$key] = self::$db->escape_string($value);
		}
		return $sanitizado;
	}
}