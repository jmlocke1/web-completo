<?php 
declare(strict_types= 1);
include 'includes/header.php';

function sumar(int $a = 0, float $b = 0){
    echo $a + $b,'<br>';
}
sumar(2,6);
sumar(6,3);


include 'includes/footer.php';