<?php include 'includes/header.php';
// require 'clases/Cliente.php';
// require 'clases/Detalles.php';
use App\Cliente;
use App\Detalles;

function mi_autoload($clase) {
    echo $clase, "<br>";
    $partes = explode('\\', $clase);
    require_once __DIR__ . '/clases/' . $partes[1] . '.php';
}
spl_autoload_register('mi_autoload');



$clientes = new Cliente();
$detalles = new Detalles();
include 'includes/footer.php';