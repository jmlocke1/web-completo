<?php include 'includes/header.php';

// in_array - Buscar elementos en un array
$carrito = ['Tablet', 'Computadora', 'Televisión'];

var_dump( in_array('Tablet', $carrito));
var_dump( in_array('Audífonos', $carrito));

// Ordenar elementos de un array
$numeros = array(1,3,4,5,1,2);
sort($numeros); // De menor a mayor
echo '<pre>';
var_dump($numeros);
echo '</pre>';

// De mayor a menor
rsort($numeros);
echo '<pre>';
var_dump($numeros);
echo '</pre>';


// Ordenar array asociativo
$cliente = array(
    'saldo' => 200,
    'tipo' => 'Premium',
    'nombre' => 'Jose'
);
echo 'Array $cliente';
echo '<pre>';
var_dump($cliente);
echo '</pre>';

echo 'asort - Ordena por valores';
asort($cliente); // Ordena por valores

echo '<pre>';
var_dump($cliente);
echo '</pre>';

echo 'arsort - Ordena por valores pero al revés';
arsort($cliente); // Ordena por valores pero al revés

echo '<pre>';
var_dump($cliente);
echo '</pre>';

echo 'ksort - Ordena por claves';
ksort($cliente); // Ordena por claves

echo '<pre>';
var_dump($cliente);
echo '</pre>';

echo 'krsort - Ordena por claves pero al revés';
krsort($cliente); // Ordena por claves pero al revés

echo '<pre>';
var_dump($cliente);
echo '</pre>';

include 'includes/footer.php';