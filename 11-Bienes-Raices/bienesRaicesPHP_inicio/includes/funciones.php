<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
require 'app.php';
require_once 'config/database.php';

$db = conectarDB();

function incluirTemplate( string $nombre, string $inicio = '' ) {
    include TEMPLATES_URL."/${nombre}.php";
}

function getTitle() {
    return ucfirst(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
}

/**
 * Devuelve el nombre de imagen de un registro de la base de datos
 */
function getImageFromDB(int $id): string {
    global $db;
    $query = "SELECT imagen FROM propiedades WHERE id=$id";
    $resultado = mysqli_query($db, $query);
    return mysqli_fetch_assoc($resultado)['imagen'];
}



/**
 * Devuelve un nombre único para una imagen
 */
function getImageName(string $nombreAntiguo): string {
    $nombreImagen = md5(uniqid( rand(), true)).".".getImageExtension($nombreAntiguo);
    return $nombreImagen;
}

/**
 * Devuelve la extensión de una imagen dada como parámetro
 */
function getImageExtension(string $imageName): string {
    $imgParts = explode('.', $imageName);
    $extension = $imgParts[count($imgParts) - 1];
    return $extension;
}

/**
 * Devuelve el path completo que lleva a la carpeta imágenes
 */
function getImageFolder(): string {
    return __DIR__."/../imagenes/";
}