<?php
namespace App;



require_once __DIR__.'/../includes/funciones/funciones.php';
class Propiedad extends ActiveRecord {
	const TABLENAME = "propiedades";
	
	protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
	protected Image $imageFile;
	
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
		
		$this->id = $args['id'] ?? null;
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

	
	
	public function eliminar(){
		$resultado = parent::eliminar();
		if($resultado){
			$this->borrarImagen();
		}
		return $resultado;
	}


	public function setImagen($imagen){
		$this->imageFile = new Image($imagen);
		// Asignar al atributo de imagen el nombre de la imagen
		if(!is_null($this->id) && $imagen){
			// Estamos editando la propiedad
			// Comprobamos si existe el archivo
			$this->borrarImagen();
		}
		if($imagen){
			$this->imagen = $this->imageFile->imageName;
		}
	}

	public function borrarImagen(){
		// Primero eliminamos la imagen
		if(!empty($this->imagen) && file_exists(\Config::CARPETA_IMAGENES . $this->imagen)){
			unlink(\Config::CARPETA_IMAGENES . $this->imagen);
		}
	}

	
	/**
	 * Valida los datos introducidos a la clase
	 */
	public function validar(){
		self::$errores = [];
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
}