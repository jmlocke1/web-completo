<?php
namespace Model;

class Notification{

	/**
	 * MENSAJES DE ÉXITO GENÉRICOS
	 */
	/**
	 * Creado correctamente
	 */
	const CREATED_SUCCESSFULLY = 'CREATED_SUCCESSFULLY';
	/**
	 * Actualizado/a correctamente
	 */
	const UPDATED_SUCCESSFULLY = 'UPDATED_SUCCESSFULLY';
	/**
	 * Eliminado correctamente
	 */
	const REMOVED_SUCCESSFULLY = 'REMOVED_SUCCESSFULLY';

	/**
	 * MENSAJES DE ERROR
	 */
	/**
	 * No se pudo crear
	 */
	const NOT_CREATED = 'NOT_CREATED';
	/**
	 * No se pudo actualizar
	 */
	const NOT_UPDATED = 'NOT_UPDATED';
	/**
	 * No se pudo eliminar
	 */
	const NOT_REMOVED = 'NOT_REMOVED';
	/**
	 * No existe
	 */
	const NOT_EXIST = 'NOT_EXIST';
	/**
	 * El identificador no es válido
	 */
	const ID_NOT_VALID = 'ID_NOT_VALID';

	/**
	 * MENSAJES DE ÉXITO
	 */
	/**
	 * Anuncio creado correctamente
	 */
	const AD_CREATED_SUCCESSFULLY = 1;
	/**
	 * Propiedad actualizada correctamente
	 */
	const PROPERTY_UPDATED_SUCCESSFULLY = 2;
	/**
	 * Propiedad eliminada correctamente
	 */
	const PROPERTY_REMOVED_SUCCESSFULLY = 3;
/**
	 * Vendedor creado correctamente
	 */
	const SELLER_CREATED_SUCCESSFULLY = 4;
	/**
	 * Vendedor eliminado correctamente
	 */
	const SELLER_REMOVED_SUCCESSFULLY = 5;
	/**
	 * Vendedor actualizado correctamente
	 */
	const SELLER_UPDATED_SUCCESSFULLY = 6;

	/**
	 * MENSAJES DE ERROR
	 */

	/**
	 * Esa propiedad no existe
	 */
	const PROPERTY_NOT_EXIST = 1;
	/**
	 * El anuncio no se pudo crear
	 */
	const ADD_COULD_NOT_BE_CREATED = 'ADD_COULD_NOT_BE_CREATED';
	/**
	 * La propiedad no se pudo actualizar
	 */
	const PROPERTY_COULD_NOT_BE_UPDATED = 2;
	/**
	 * La propiedad no se pudo eliminar
	 */
	const PROPERTY_COULD_NOT_BE_REMOVED = 3;
	/**
	 * Vendedor no se pudo crear
	 */
	const SELLER_COULD_NOT_BE_CREATED = 4;
	/**
	 * Vendedor no se pudo eliminar
	 */
	const SELLER_COULD_NOT_BE_DELETED = 5;
	/**
	 * Vendedor no se pudo actualizar
	 */
	const SELLER_COULD_NOT_BE_UPDATED = 6;
	/**
	 * Vendedor no existe
	 */
	const SELLER_NOT_EXIST = 7;
	

	public static function successNotification($code){
		$mensaje = "";
		switch($code){
			case self::CREATED_SUCCESSFULLY:
				$mensaje = "Creado correctamente";
				break;
			case self::UPDATED_SUCCESSFULLY:
				$mensaje = "Actualizado/a correctamente";
				break;
			case self::REMOVED_SUCCESSFULLY:
				$mensaje = "Eliminado/a correctamente";
				break;
			case self::AD_CREATED_SUCCESSFULLY:
				$mensaje = "Anuncio creado correctamente";
				break;
			case self::PROPERTY_UPDATED_SUCCESSFULLY:
				$mensaje = "Propiedad actualizada correctamente";
				break;
			case self::PROPERTY_REMOVED_SUCCESSFULLY:
				$mensaje = "Propiedad eliminada correctamente";
				break;
			case self::SELLER_CREATED_SUCCESSFULLY:
				$mensaje = "Vendedor creado correctamente";
				break;
			case self::SELLER_REMOVED_SUCCESSFULLY:
				$mensaje = "Vendedor eliminado correctamente";
				break;
			case self::SELLER_UPDATED_SUCCESSFULLY:
				$mensaje = "Vendedor actualizado correctamente";
				break;
			default:
				$mensaje .= "";
		}
		return $mensaje;
	}

	public static function errorNotification($code){
		$mensaje = "";
		switch($code){
			case self::NOT_CREATED:
				$mensaje = "No se pudo crear";
				break;
			case self::NOT_UPDATED:
				$mensaje = "No se pudo actualizar";
				break;
			case self::NOT_REMOVED:
				$mensaje = "No se pudo eliminar";
				break;
			case self::NOT_EXIST:
				$mensaje = "No existe";
				break;
			case self::ID_NOT_VALID:
				$mensaje = "El identificador no es válido";
				break;
			case self::ADD_COULD_NOT_BE_CREATED:
				$mensaje = "El anuncio no se pudo crear";
				break;
			case self::PROPERTY_NOT_EXIST:
				$mensaje = "Esa propiedad no existe";
				break;
			case self::PROPERTY_COULD_NOT_BE_UPDATED:
				$mensaje = "La propiedad no se pudo actualizar";
				break;
			case self::PROPERTY_COULD_NOT_BE_REMOVED:
				$mensaje = "La propiedad no se pudo eliminar";
				break;
			case self::SELLER_COULD_NOT_BE_DELETED:
				$mensaje = "El vendedor no se pudo eliminar";
				break;
			case self::SELLER_NOT_EXIST:
				$mensaje = "El vendedor no existe";
				break;
			case self::SELLER_COULD_NOT_BE_UPDATED:
				$mensaje = "El vendedor no se pudo actualizar";
				break;
		}
		return $mensaje;
	}
}