<?php
if(!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
require __DIR__.'/app.php';
require_once __DIR__.'/config/database.php';

$db = conectarDB();

function incluirTemplate( string $nombre, string $inicio = '' ) {
    include TEMPLATES_URL."/${nombre}.php";
}

function deleteProperty(int $id): bool {
    global $db;
    // Primero eliminamos la imagen
    deleteImageProperty($id);
    // Borramos la propiedad
    $query = "DELETE FROM propiedades WHERE id=${id}";
    $result = mysqli_query($db, $query);
    $exito = $db->affected_rows > 0;
    if($exito){
        // Reciclamos el id
        setIdRecicled($id);
    }
    return $exito;
}

function deleteImageProperty(int $id): bool {
    $imageName = getImageFromDB($id);
    $exito = false;
    if($imageName) {
        $imageFolder = getImageFolder();
        if(file_exists( $imageFolder . $imageName)) {
            unlink($imageFolder . $imageName);
            $exito = true;
        }
    }
    return $exito;
}
    

function createProperty( $titulo, $precio, $nombreImagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorId) {
    global $db;
    $id = getIdRecicledAndDelete();
    if($id > 0) {
        $idField = 'id, ';
        $idValue = $id . ', ';
    }else {
        $idField = '';
        $idValue = '';
    }
    
    $query = " INSERT INTO propiedades ($idField titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) ";
    $query .= " VALUES ($idValue '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";
    $resultado = mysqli_query($db, $query);
    return $resultado;
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
    $imagen = mysqli_fetch_assoc($resultado)['imagen'];
    return isset($imagen) ? $imagen : '';
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

function setIdRecicled( int $id ): bool {
    global $db;
    $query = "INSERT INTO ids_available VALUES ($id)";
    return mysqli_query($db, $query);
}

function getIdRecicledAndDelete(): int {
    $id = getIdRecicled();
    deleteIdRecicled($id);
    return $id;
}

function getIdRecicled(): int {
    global $db;
    $query = "SELECT min(id) as id FROM ids_available";
    $result = mysqli_query($db, $query);
    $id = mysqli_fetch_assoc($result)['id'];
    return isset($id) ? intval($id) : 0;
}

function deleteIdRecicled(int $id) {
    global $db;
    $query = "DELETE FROM ids_available WHERE id=$id";
    mysqli_query($db, $query);
    return $db->affected_rows > 0;
}

function truncate(string $texto, int $cantidad) : string
{
    if(strlen($texto) >= $cantidad) {
        return "<span title='$texto'>" . substr($texto, 0, $cantidad) . " ...</span>";
    } else {
        return $texto;
    }
}

function getReferer() {
    $protocolos = array('http://', 'https://', 'ftp://', 'www.');
    $referer = $_SERVER["HTTP_REFERER"];
    // Limpiamos los posibles parámetros get
    $url = explode('?', $referer)[0];
    // Extraemos el protocolo
    $url = str_replace($protocolos, '', $url);
    // Extraemos el dominio
    $domain = explode('/', $url)[0];
    // Eliminamos el dominio de la url
    $url = str_replace($domain, '', $url);
    
    return $url;
}

function estaAutenticado(): bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    
    $auth = $_SESSION['login'] ?? false;
    if($auth) {
        return true;
    }
    return false;
}