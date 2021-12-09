<?php 
declare(strict_types = 1);
include 'includes/header.php';

class Transporte {
	private string $nombre = "El Transporte";
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		
	}

	public function getInfo() : string {
		return $this->nombre ." tiene $this->ruedas ruedas y una capacidad de $this->capacidad personas";
	}
}

class Bicicleta extends Transporte {
	private string $nombre = "La Bicicleta";
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		
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
	private string $nombre = "El Automóvil";
	public function __construct(protected int $ruedas, protected int $capacidad)
	{
		
	}

	public function getInfo(): string
	{
		return $this->nombre . parent::getInfo();
	}
}

$bicicleta = new Bicicleta(2,1);
echo $bicicleta->getInfo()."<br>";
echo $bicicleta->getRuedas();
echo "<hr>";

$automovil = new Automovil(4,4);
echo $automovil->getInfo();
echo "<hr>";

include 'includes/footer.php';