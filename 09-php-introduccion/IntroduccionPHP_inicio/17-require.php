<?php 
declare(strict_types= 1);
include 'includes/header.php';

require 'funciones.php';
iniciarApp();

echo "<p>Última modificación del archivo: " . date("F d Y H:i:s.", getlastmod())."</p>";


include 'includes/footer.php';