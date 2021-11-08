<?php include 'includes/header.php';

// Útil para ver los contenidos de un array
$carrito = ['Tablet', 'Televisión', 'Computadora'];
echo '<pre>';
var_dump($carrito);
echo '</pre>';

// Acceder a un elemento de un array
echo $carrito[1];

$carrito[3] = "Nuevo producto...";
$carrito[] = "Otro producto";
echo '<pre>';
var_dump($carrito);
echo '</pre>';
include 'includes/footer.php';