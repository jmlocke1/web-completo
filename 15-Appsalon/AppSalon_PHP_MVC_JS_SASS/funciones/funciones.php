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

function validarFecha(string $fecha = '') : bool {
    if(empty($fecha)){
        return false;
    }
    $fecha = explode('-', $fecha);
    return checkdate($fecha[1], $fecha[2], $fecha[0]);
}

function isAdmin(){
    if(!isset($_SESSION['admin'])){
        // Si no es administrador se redirige a cita, si está logueado
        header('Location: /');
    }
}

function iniciaSesión(){
    if(!isset($_SESSION)){
        session_start();
    }
}