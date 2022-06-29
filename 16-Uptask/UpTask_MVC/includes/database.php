<?php

$db = mysqli_connect('localhost', Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
