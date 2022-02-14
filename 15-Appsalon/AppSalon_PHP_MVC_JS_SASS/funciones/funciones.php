<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo) : bool {
    if($actual !== $proximo){
        return true;
    }else{
        return false;
    }
    
}

/**
 * Función que comprueba si el usuario está autenticado
 *
 * @return void
 */
function isAuth() :void {
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}