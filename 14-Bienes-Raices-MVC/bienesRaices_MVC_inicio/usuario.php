<?php
require 'includes/app.php';

// // Crear un email y password
// $email = "correo@correo.com";
// $password = "123456";

$email = "correo2@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

echo "<pre>";
var_dump($passwordHash);
echo "</pre>";

// Query para crear el usuario
$query = " INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}')";


mysqli_query($db, $query);