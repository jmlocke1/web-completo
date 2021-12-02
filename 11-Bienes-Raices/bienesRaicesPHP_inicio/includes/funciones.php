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

function getImage(int $id) {

}