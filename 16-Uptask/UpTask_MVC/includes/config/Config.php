<?php

define('DIR_ROOT', dirname(dirname(__DIR__)));
define('FUNCIONES_URL', DIR_ROOT.'/funciones');
define('TEMPLATES_URL', DIR_ROOT.'/includes/templates');

if(!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
/**
 * Configuración de la aplicación AppSalon.
 */
class Config {
	/**
	 * Dominio del proyecto
	 */
	const DOMAIN_PROJECT = 'uptask.test';
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
	 *  Coste del algoritmo de generación de claves
	 */ 
    const PASSWORD_COST = 10;
	
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
	const DB_NAME = 'uptask_mvc';

	// Configuración de mailer
	/**
	 * Host de mailtrap
	 */
	const MAILTRAP_HOST = 'smtp.mailtrap.io';
	/**
	 * Puerto de mailtrap
	 */
	const MAILTRAP_PORT = 2525;
	const MAILTRAP_USERNAME = '7e616050a54470';
	const MAILTRAP_PASSWORD = '9b8bd746ca9ac6';
	/**
	 * Email desde donde se mandan las notificaciones. En el despliegue
	 * hay que poner el adecuado, pues este es de prueba y no existe.
	 */
	const MAIL_ORIGIN = 'cuentas@uptask.com';
}