<?php
namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord {
	protected static $tabla = 'proyectos';
	protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId'];

	public $id;
	public $proyecto;
	public $url;
	public $propietarioId;

	public function __construct($args = [])
	{
		$this->id = $args['id'] ?? null;
		$this->proyecto = $args['proyecto'] ?? null;
		$this->url = $args['url'] ?? null;
		$this->propietarioId = $args['propietarioId'] ?? null;
	}

	public function validarProyecto(){
		if(!$this->proyecto){
			self::setAlerta('error', 'El nombre del proyecto es obligatorio');
		}
		return self::$alertas;
	}

	public function setURL(){
		$propietarioId = $this->propietarioId ?? rand(1, 512);
		$this->url = md5(uniqid($propietarioId));
	}
}