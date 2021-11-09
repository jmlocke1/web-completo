<?php 
declare(strict_types= 1);
include 'includes/header.php';

$productos = [
    [
        'nombre' => 'Tablet',
        'precio' => 200,
        'disponible' => true
    ],
    [
        'nombre' => 'Televisión 24"',
        'precio' => 300,
        'disponible' => true
    ],
    [
        'nombre' => 'Monitor Curvo',
        'precio' => 400,
        'disponible' => false
    ]
];

$prod = json_encode($productos);
echo "<pre>";
var_dump($productos);
var_dump($prod);
$json_array = json_decode($prod);
var_dump($json_array);
echo "</pre>";


include 'includes/footer.php';