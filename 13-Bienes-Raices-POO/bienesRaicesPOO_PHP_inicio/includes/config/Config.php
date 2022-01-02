<?php
define('TEMPLATES_URL', __DIR__.'/../templates');
define('FUNCIONES_URL', __DIR__.'/../funciones/funciones.php');
define('LIMITE_ANUNCIOS_INDEX', 3);
define('TRUNCATE_LIMIT', 80);

if(!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

class Config {
	const PRUEBA = "Frase de prueba";
}