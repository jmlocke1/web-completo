<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function debuguearSinExit($variable)  {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function iniciar_sesion(): void {
    if(!isset($_SESSION)) {
        session_start();
    }
}
