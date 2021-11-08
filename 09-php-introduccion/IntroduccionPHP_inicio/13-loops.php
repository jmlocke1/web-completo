<?php include 'includes/header.php';

/**
 * 3 imprimir Fizz
 * 5 imprimir Buzz
 * 
 */
// for loop.
for ($i = 0; $i < 20; $i++){
    echo comprueba($i);
}

function comprueba($i){
    $resultado = '';
    switch(true){
        case ($i % 3 === 0) && ($i % 5 === 0):
            $resultado =  $i.'Fizz Buzz';
            break;
        case ($i % 3 === 0):
            $resultado = $i."Fizz";
            break;
        case ($i % 5 === 0):
            $resultado = $i."Buzz";
            break;
    }
    if(!empty($resultado)){
        $resultado .= '<br>';
    }
    return $resultado;
}
include 'includes/footer.php';