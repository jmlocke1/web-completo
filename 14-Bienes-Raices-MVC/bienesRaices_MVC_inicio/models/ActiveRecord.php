<?php
namespace Model;
use Model\Database\DB;


class ActiveRecord {
	const TABLENAME = '';
	protected static $db;
	protected static $errores = [];
	protected static $notifications = [];
	/**
	 * Clave o claves primarias. Si la clave primaria es diferente de 'id', hay que incluirla en
	 * este array en la clase hija. Si hay más de una clave primaria se añaden cuantos valores hagan
	 * falta
	 */
	protected static $primaryKeys = [];
	/**
	 * Script de destino en caso de éxito
	 */
	protected static $destinationOnSuccess = '';
	/**
	 * Script de destino en caso de error
	 */
	protected static $destinationOnError = '';
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
	 * Busca un registro por su id. 
	 * Si el identificador es múltiple, se llama a la función findArray, 
	 * a la que también se la puede llamar directamente.
	 * @param any
	 * @return object Objeto de la clase que hereda de ActiveRecord
	 */
	public static function find($id){
		if(is_array($id)){
			return self::findArray($id);
		}
		$query = "SELECT * FROM ".get_called_class()::TABLENAME." WHERE id='$id'";
		$result = self::consultarSQL($query);
		// Devuelve el primer elemento del array
		return array_shift($result);
	}

	/**
	 * Busca un registro por su clave primaria combinada
	 * 
	 * @param array		Vector con las claves primarias a buscar
	 * @return object 	Objeto de la clase que hereda de ActiveRecord
	 */
	public static function findArray(array $primaryKeys){
		$fieldIds= '';
		$and = '';
		foreach($primaryKeys as $key => $id){
			$fieldIds .= $and.$key."='$id'";
			$and = " AND ";
		}
		$query = "SELECT * FROM ".get_called_class()::TABLENAME." WHERE $fieldIds";
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
			if(self::isPrimaryKey($key)) continue;
			
			if(property_exists($this, $key) && !is_null($value)){
				$this->$key = $value;
			}
		}
	}

	public function sanitizarAtributos(){
		$atributos = $this->atributos();
		$sanitizado = [];
		foreach($atributos as $key => $value){
			if(self::isPrimaryKey($key)) continue;
			$sanitizado[$key] = self::$db->escape_string($value);
		}
		return $sanitizado;
	}

	/**
	 * Comprueba si el id es válido. Si es válido devuelve un objeto con ese id.
	 * Si el objeto no existe redirecciona a otra página mostrando un mensaje de error
	 */
	public static function existsById($id, $destination = null){
		$id = filter_var($id, FILTER_VALIDATE_INT);
		$destination = $destination ?? static::$destinationOnError;
		if(!$id){
			header('Location: '.$destination.'?error='. static::$notifications['idNotValid']);
			exit;
		}
		$object = static::find($id);
		// Comprobamos si existe el objeto
		if(is_null($object)){
			header('location: '.$destination.'?error='.static::$notifications['notExist']);
			exit;
		}
		return $object;
	}

	protected static function isPrimaryKey($key){
		return ($key === 'id' || in_array($key, static::$primaryKeys));
	}
}