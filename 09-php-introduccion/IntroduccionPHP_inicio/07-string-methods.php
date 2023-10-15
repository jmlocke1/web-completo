<?php include 'includes/header.php';

$nombreCliente = "     José Miguel     ";

// Conocer extensión de un string
echo strlen($nombreCliente);
var_dump($nombreCliente);

$texto = trim($nombreCliente);
echo '<br>', strlen($texto);

$tipoCliente = "Premium";
define("PRUEBA", "Valor de prueba");
echo PRUEBA, "<br>";
echo "El Cliente ". $nombreCliente." es ".$tipoCliente;
echo "<br>El cliente $nombreCliente es $tipoCliente PRUEBA, {PRUEBA}".PRUEBA;
echo "<br>El cliente {$nombreCliente} es {$tipoCliente}";
include 'includes/footer.php';