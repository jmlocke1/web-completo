<?php include 'includes/header.php';

$clientes = [];
$clientes2 = array();
$clientes3 = array('Pedro', 'Juan', 'Karen');

var_dump(empty($clientes));
var_dump(empty($clientes2));
var_dump(empty($clientes3));

// Isset - Revisar si un arreglo está creado o una propiedad parecida
echo '<br>';
var_dump(isset($clientes4));
var_dump(isset($clientes));
var_dump(isset($clientes2));
var_dump(isset($clientes3));

include 'includes/footer.php';