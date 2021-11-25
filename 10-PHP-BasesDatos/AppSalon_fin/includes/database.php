<?php
$db = mysqli_connect('localhost', 'usprueba', 'usprueba', 'appsalon');

if(!$db){
    echo "Error en la conexión";
    exit();
} else {
    // echo "Conexión correcta";
}