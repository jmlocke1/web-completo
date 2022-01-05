<?php
namespace App;

use App\Database\DB;

require_once __DIR__.'/../includes/funciones/funciones.php';
class Propiedad {
	const TABLENAME = "propiedades";
	protected static $db;
	protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
	protected static $errores = [];
	public $id;
	public $titulo;
	public $precio;
	public $imagen;
	public $descripcion;
	public $habitaciones;
	public $wc;
	public $estacionamiento;
	public $creado;
	public $vendedorId;
	public function __construct($args = [])
	{
		self::hayDB();
		
		$this->id = $args['id'] ?? '';
		$this->titulo = $args['titulo'] ?? '';
		$this->precio = $args['precio'] ?? '';
		$this->imagen = $args['imagen'] ?? '';
		$this->descripcion = $args['descripcion'] ?? '';
		$this->habitaciones = $args['habitaciones'] ?? '';
		$this->wc = $args['wc'] ?? '';
		$this->estacionamiento = $args['estacionamiento'] ?? '';
		$this->creado = date('Y/m/d');
		$this->vendedorId = $args['vendedorId'] ?? '';
	}

	public function guardar() {
		// Sanitizar los datos
		$atributos = $this->sanitizarAtributos();

		$query = " INSERT INTO propiedades ( ";
		$query .= join(", ", array_keys($atributos));
		$query .= ") ";
    	$query .= " VALUES ( '";
		$query .= join("', '", array_values($atributos));
		$query .= "' )";
		return DB::insert($query);
	}
	
	/**
	 * Identifica y uno los atributos de la BD
	 */
	public function atributos(): array{
		$atributos = [];
		foreach(self::$columnasDB as $columna){
			$atributos[$columna] = $this->$columna;
		}
		return $atributos;
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

	public function setImagen($imagen){
		// Asignar al atributo de imagen el nombre de la imagen
		if($imagen){
			$this->imagen = $imagen;
		}
	}

	public static function getErrors(){
		return self::$errores;
	}

	public function validar(){
		if(!$this->titulo) {
			self::$errores[] = "Debes añadir un título";
		}
		if(!$this->precio) {
			self::$errores[] = "El precio es obligatorio";
		}
		if(strlen( $this->descripcion ) < 50) {
			self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
		}
		if(!$this->habitaciones) {
			self::$errores[] = "El número de habitaciones es obligatorio";
		}
		if(!$this->wc) {
			self::$errores[] = "El número de baños es obligatorio";
		}
		if(!$this->estacionamiento) {
			self::$errores[] = "El número de estacionamientos es obligatorio";
		}
		if(!$this->vendedorId) {
			self::$errores[] = "Elige un vendedor";
		}
		if(!$this->imagen) {
			self::$errores[] = 'La imagen es obligatoria';
		}

		return self::$errores;
	}

	public static function all(){
		$query = "SELECT * FROM ".self::TABLENAME;
		$resultado = self::consultarSQL($query);
		return $resultado;
	}

	public static function consultarSQL($query){
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
		$objeto = new self;
		foreach($registro as $key => $value){
			if(property_exists( $objeto, $key )){
				$objeto->$key = $value;
			}
		}
		return $objeto;
	}

	/**
	 * Comprueba si tenemos conexión a la base de datos, de lo contrario obtiene una
	 */
	private static function hayDB(){
		if(!isset(self::$db)){
			self::$db = DB::getDB();
		}
	}
}