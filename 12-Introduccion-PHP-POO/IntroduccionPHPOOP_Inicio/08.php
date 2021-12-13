<?php include 'includes/header.php';
// require 'clases/Cliente.php';
// require 'clases/Detalles.php';

function mi_autoload($clase) {
    echo $clase, "<br>";
    require_once __DIR__ . '/clases/' . $clase . '.php';
}
spl_autoload_register('mi_autoload');
$detalles = new Detalles();
$clientes = new Cliente();
include 'includes/footer.php';