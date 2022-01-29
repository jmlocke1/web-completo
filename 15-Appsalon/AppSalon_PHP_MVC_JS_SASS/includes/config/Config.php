<?php
//namespace App\Config;
define('DIR_ROOT', dirname(dirname(__DIR__)).'/');
define('FUNCIONES_URL', DIR_ROOT.'funciones/funciones.php');
define('TEMPLATES_URL', DIR_ROOT.'includes/templates');

if(!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

class Config {
	const CONSTANTE_PRUEBA = 'Prueba de constante en clase';
	/**
	 * Carpeta de imágenes para PHP
	 */
	const CARPETA_IMAGENES = DIR_ROOT."/public/build/img/";
	/**
	 * Carpeta de imágenes para la vista
	 */
	const CARPETA_IMAGENES_VIEW = '/build/img/';

	/**
	 * Longitud mínima del password
	 */
	const MIN_LENGTH_PASSWORD = 6;
	
	/**
	 * Host de la base de datos
	 */
	const DB_HOST = 'localhost';
	/**
	 * Usuario de la base de datos
	 */
	const DB_USER = 'usprueba';
	/**
	 * Password del usuario de la base de datos
	 */
	const DB_PASSWORD = 'usprueba';
	/**
	 * Nombre de la base de datos
	 */
	const DB_NAME = 'appsalon_mvc';
}