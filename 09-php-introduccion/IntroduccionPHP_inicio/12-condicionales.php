<?php include 'includes/header.php';

$autenticado = true;

if($autenticado) {
    echo 'El usuario está autenticado';
}else {
    echo 'El usuario no está autenticado';
}
echo '<br>';
$premium = true;
if($autenticado) {
    if($premium){
        echo "El usuario es premium y está autenticado";
    }else {
        echo "El usuario premium no está autenticado";
    }
} else {
   echo "El usuario no está autenticado";
}
echo '<br>';
// En este caso se podría sustituir por:
if($autenticado && $premium) {
    echo "El usuario es premium y está autenticado";
} else {
   echo "El usuario no está autenticado";
}

echo '<br>';


if($autenticado) {
    autenticado($premium);
} else {
   echo "El usuario no está autenticado";
}

function autenticado($premium) {
    if($premium){
        echo "El usuario es premium y está autenticado";
    }else {
        echo "El usuario no es premium pero está autenticado";
    }
}

// if anidados
$cliente = [
    'nombre' => 'Jose',
    'saldo' => 200,
    'informacion' => [
        'tipo' => 'Premium',
        'disponible' => 100
    ]
];

if( !empty($cliente)){
    if($cliente['saldo'] > 0){
        echo 'El cliente tiene saldo disponible';
    }else {
        echo 'No hay saldo';
    }
}else{
    echo 'El array de cliente está vacío';
}

// Versión más limpia

function saldoCliente($cliente){
    if($cliente['saldo'] > 0){
        echo 'El cliente tiene saldo disponible';
    }else {
        echo 'No hay saldo';
    }
}

if( !empty($cliente)){
    saldoCliente($cliente);
}else{
    echo 'El array de cliente está vacío';
}

include 'includes/footer.php';