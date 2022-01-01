<?php include 'includes/header.php';

$db = new mysqli('localhost', 'usprueba', 'usprueba', 'bienes_raices');
$query = "SELECT titulo from propiedades";
$resultado = $db->query($query);
var_dump($resultado->fetch_assoc());



include 'includes/footer.php';