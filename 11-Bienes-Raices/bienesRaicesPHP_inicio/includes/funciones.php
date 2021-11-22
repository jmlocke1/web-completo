<?php
require 'app.php';
require_once 'config/database.php';

function incluirTemplate( string $nombre, string $inicio = '' ) {
    include TEMPLATES_URL."/${nombre}.php";
}

function getTitle() {
    return ucfirst(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
}