<?php
define('DIR_ROOT', dirname(dirname(__DIR__)).'/');
define('TEMPLATES_URL', DIR_ROOT.'includes/templates');
define('FUNCIONES_URL', DIR_ROOT.'funciones/funciones.php');
define('LIMITE_ANUNCIOS_INDEX', 3);
define('TRUNCATE_LIMIT', 80);

if(!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

class Config {
	const CONSTANTE_PRUEBA = 'Prueba de constante en clase';
	const CARPETA_IMAGENES = DIR_ROOT."imagenes/";
}