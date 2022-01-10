<?php
namespace App;
use App\Database\DB;


class ActiveRecord {
	const TABLENAME = '';
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
	 * Lista un determinado número de  registros
	 */
	public static function get($limit = null, $offset = null){
		
		$query = "SELECT * FROM ".get_called_class()::TABLENAME;
		if(isset($limit)){
			$query .= " LIMIT {$limit}";
		}
		if(isset($offset)){
			$query .= " OFFSET {$offset}";
		}
		$resultado = self::consultarSQL($query);
		return $resultado;
	}

	/**
	 * Busca un registro por su id
	 */
	public static function find($id){
		$query = "SELECT * FROM ".get_called_class()::TABLENAME." WHERE id='$id'";
		$result = self::consultarSQL($query);
		// Devuelve el primer elemento del array
		return array_shift($result);
	}

	public function eliminar(){
		// Eliminar el registro
		$query = "DELETE FROM ". static::TABLENAME ." WHERE id='".self::$db->escape_string($this->id)."' LIMIT 1";
		$resultado = self::$db->query($query);
		return $resultado;
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

	public function guardar(){
		if(!is_null($this->id)){
			// Actualizar
			return $this->actualizar();
		}else{
			// Creando un nuevo registro
			return $this->crear();
		}
	}

	public function crear() {
		// Sanitizar los datos
		$atributos = $this->sanitizarAtributos();
		
		$query = " INSERT INTO ".get_called_class()::TABLENAME." ( ";
		$query .= join(", ", array_keys($atributos));
		$query .= " ) ";
    	$query .= " VALUES ( '";
		$query .= join("', '", array_values($atributos));
		$query .= "' )";
		
		$resultado = self::$db->query($query);
		if($resultado && isset($this->imageFile)){
			// Guardar imagen
			$this->imageFile->guardar();
		}
		return $resultado;
	}

	public function actualizar(){
		// Sanitizar los datos
		$atributos = $this->sanitizarAtributos();

		$valores = [];
		foreach($atributos as $key => $value){
			$valores[] = "{$key}='{$value}'";
		}
		$query = "UPDATE ". static::TABLENAME ." SET ". join(', ', $valores);
		$query .= " WHERE id='". self::$db->escape_string($this->id). "' ";
		$query .= " LIMIT 1";
		
		$resultado = self::$db->query($query);
		if($resultado && isset($this->imageFile)){
			// Guardar imagen
			$this->imageFile->guardar();
		}
		return $resultado;
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