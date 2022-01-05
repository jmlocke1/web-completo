<?php
namespace App;
use App\Database\DB;
class ActiveRecord {
	protected static $db;


	/**
	 * Comprueba si tenemos conexión a la base de datos, de lo contrario obtiene una
	 */
	protected static function hayDB(){
		if(!isset(self::$db)){
			self::$db = DB::getDB();
		}
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
}