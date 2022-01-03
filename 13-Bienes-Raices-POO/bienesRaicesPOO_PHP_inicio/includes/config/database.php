<?php
use App\Database\DB;

function conectarDB() {
    $db = mysqli_connect('localhost', 'usprueba', 'usprueba', 'bienes_raices');

    if(!$db) {
        echo "Error. No se pudo conectar";
        exit;
    }
    return $db;
}

//$db = DB::getDB();