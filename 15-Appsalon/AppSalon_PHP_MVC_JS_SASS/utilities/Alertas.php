<?php
namespace MVC\Utilities;

class Alertas {
	/**
	 * Constantes de éxito
	 */
	const SERVICE_UPDATED_SUCCESSFULLY = 'service-updated-successfully';
	const SERVICE_CREATED_SUCCESSFULLY = 'service-created-successfully';
	const SERVICE_REMOVED_SUCCESSFULLY = 'service-removed-successfully';

	/**
	 * Constantes de error
	 */
	const ID_NOT_VALID = 'id-not-valid';
	const SERVICE_NOT_EXIST = 'service-not-exist';
	const SERVICE_COULD_NOT_BE_REMOVED = 'El servicio no se ha podido eliminar'; 

	private static $alertas = [];

	public static function setErrorMessage($message){
		$errorMessage = '';
		switch ($message) {
			case self::ID_NOT_VALID:
				self::$alertas['error'][] = "Id no válido";
				break;
			case self::SERVICE_NOT_EXIST:
				self::$alertas['error'][] = 'El servicio solicitado no existe';
				break;
			default:
				self::$alertas['error'][] = 'Ha ocurrido un error indeterminado';
				break;
		}
		return self::$alertas;
	}

	public static function setSuccessMessage($message){
		$successMessage = '';
		switch ($message) {
			case self::SERVICE_UPDATED_SUCCESSFULLY:
				self::$alertas['exito'][] = 'Servicio actualizado correctamente';
				break;
			case self::SERVICE_CREATED_SUCCESSFULLY:
				self::$alertas['exito'][] = 'Servicio creado correctamente';
				break;
			case self::SERVICE_REMOVED_SUCCESSFULLY:
				self::$alertas['exito'][] = 'Servicio eliminado correctamente';
				break;
			
			default:
				self::$alertas['exito'][] = 'Ha ocurrido un éxito indeterminado';
				break;
		}
	}

	public static function getAlertsFromArray($alertas = null){
		if(isset($alertas['exito'])){
			self::setSuccessMessage($alertas['exito']);
		}
		if(isset($alertas['error'])){
			self::setErrorMessage($alertas['error']);
		}
		return self::$alertas;
	}

	public static function getAlertas(){
		return self::$alertas;
	}
}