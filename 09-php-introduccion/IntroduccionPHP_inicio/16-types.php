<?php 
declare(strict_types= 1);

include 'includes/header.php';
class Pru{
    private int $pru;
    public function __construct(int $a){
        $this->pru = $a;
    }

    function getPru(){
        return $this->pru;
    }
}

// Valores de retorno de una función. Se declaran con dos puntos
// El valor de retorno puede ser un tipo primitivo, como int, float,
// O una clase

function usuarioAutenticado(bool $aut): Pru|int {
    //return "El usuario está autenticado";
    if($aut){
        return new Pru(5);
    }else{
        return 7;
    }
}
$b = usuarioAutenticado(false);
echo $b->getPru();
var_dump($b->getPru()) ;

include 'includes/footer.php';