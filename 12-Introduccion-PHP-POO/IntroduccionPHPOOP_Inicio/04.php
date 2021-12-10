<?php 
declare(strict_types = 1);
include 'includes/header.php';

class Transporte {
	protected string $nombre;
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		$this->nombre = "El Transporte";
	}

	public function getInfo() : string {
		return $this->nombre ." tiene $this->ruedas ruedas y una capacidad de $this->capacidad persona".($this->capacidad > 1 ? 's.' : '.');
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

	public function getRuedas() {
		return $this->ruedas;
	}
}

class Automovil extends Transporte {
	
	public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision)
	{
		$this->nombre = "El Automóvil";
	}

	public function getTransmision() : string {
		return $this->transmision;
	}

	public function getInfo() : string {
		return parent::getInfo()." Tiene una transmisión: " . $this->getTransmision();
	}
}

$bicicleta = new Bicicleta(2,1);
echo $bicicleta->getInfo()."<br>";
echo $bicicleta->getRuedas();
echo "<hr>";

$automovil = new Automovil(4,4, 'Manual');
echo $automovil->getInfo()."<br>";
echo "Tiene una transmisión: ", $automovil->getTransmision();
echo "<hr>";
echo $bicicleta->getInfo()."<br>";
echo "<hr>";
include 'includes/footer.php';