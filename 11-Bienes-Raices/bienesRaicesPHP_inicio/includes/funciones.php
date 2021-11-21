<?php
require 'app.php';
function incluirTemplate( string $nombre, string $inicio = '' ) {
    include TEMPLATES_URL."/${nombre}.php";
}