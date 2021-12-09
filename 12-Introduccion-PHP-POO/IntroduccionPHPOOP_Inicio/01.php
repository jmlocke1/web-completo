<?php 
declare(strict_types = 1);
include 'includes/header.php';

// Definir una clase
class Producto {
	public static int $instancia = 0;
	public string $nombre;
	public float $precio;
	public bool $disponible;
	public function __construct(string $nombre = '', float $precio = 0.0, bool $disponible = false){
		self::$instancia += 1;
		$this->nombre = $nombre;
		$this->precio = $precio;
		$this->disponible = $disponible;
	}

	public function showDetails() {
		return "El producto es: $this->nombre y su precio es de: $this->precio";
	}
}
// Sintaxis de PHP 8
// class Producto8 {
// 	public static int $instancia = 0;
	
// 	public function __construct(public string $nombre = '', public float $precio = 0.0, public bool $disponible = false){
// 		//self::$instancia += 1;
// 	}
// }
$producto = new Producto('Tablet', 200.45, true);

echo "<pre>";
echo "Objeto con sintaxis de PHP 8<br>";
var_dump($producto);
echo "Objeto: ";
var_dump($producto::$instancia);
echo $producto->showDetails()."<br>";
echo "</pre>";

$producto2 = new Producto('Monitor Curvo', 300.50, true);

echo "<pre>";
var_dump($producto2);
echo "Objeto: ";
var_dump($producto2::$instancia);
echo $producto2->showDetails()."<br>";
echo "</pre>";

$producto3 = new Producto('Monitor Curvo', 300.34, false);

echo "<pre>";
var_dump($producto3);
echo "Objeto: ";
var_dump($producto3::$instancia);
echo $producto3->showDetails()."<br>";
echo gettype($producto3->precio);
echo "</pre>";

include 'includes/footer.php';