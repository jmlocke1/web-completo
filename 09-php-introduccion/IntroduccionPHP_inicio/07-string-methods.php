<?php include 'includes/header.php';

$nombreCliente = "     José Miguel     ";

// Conocer extensión de un string
echo strlen($nombreCliente);
var_dump($nombreCliente);

$texto = trim($nombreCliente);
echo '<br>', strlen($texto);


include 'includes/footer.php';