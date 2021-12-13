<?php 
declare(strict_types = 1);


include 'includes/header.php';

interface TransporteInterfaz {
    public function getInfo() : string;
    public function getRuedas() : int;
}
   
class Transporte implements TransporteInterfaz {
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		
	}

	public function getInfo() : string {
		return "El transporte tiene $this->ruedas ruedas y una capacidad de $this->capacidad persona".($this->capacidad > 1 ? 's.' : '.');
	}
    public function getRuedas() : int {
		return $this->ruedas;
	}
}

class Bicicleta extends Transporte {
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		$this->nombre = "La Bicicleta";
	}
	// public function getInfo(): string
	// {
	// 	return $this->nombre . parent::getInfo();
	// }

	
}

class Automovil extends Transporte implements TransporteInterfaz {
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $color)
    {
        # code...
    }

    public function getInfo() : string {
		return "El transporte AUTO tiene $this->ruedas ruedas y una capacidad de $this->capacidad persona".($this->capacidad > 1 ? 's.' : '.');
	}

    public function getColor() {
        return "El color es: ". $this->color;
    }
}

echo "<pre>";
var_dump($transporte = new Transporte(8, 20));
var_dump($auto = new Automovil(4, 4, "Rojo"));
echo "</pre>";
echo $transporte->getInfo(), "<br>";
echo $auto->getInfo(), "<br>";
echo $auto->getColor(), "<br>";
include 'includes/footer.php';