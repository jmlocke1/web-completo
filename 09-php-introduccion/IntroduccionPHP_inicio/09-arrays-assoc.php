<?php include 'includes/header.php';

$cliente = [
    'nombre' => 'Jose',
    'saldo' => 200,
    'informacion' => [
        'tipo' => 'Premium',
        'disponible' => 100
    ]
];

echo '<pre>';
var_dump($cliente);
echo '</pre>';
echo '<br>', $cliente['informacion']['tipo'], '<br>';

$cliente['codigo'] = 1232448;
echo '<pre>';
var_dump($cliente);
echo '</pre>';


include 'includes/footer.php';