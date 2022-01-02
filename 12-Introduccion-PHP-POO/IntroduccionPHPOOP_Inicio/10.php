<?php include 'includes/header.php';
// Conectar a la BD con PDO
$db = new PDO('mysql:host=localhost; dbname=bienes_raices', 'usprueba', 'usprueba');

// Creamos el query
$query = "SELECT titulo, imagen from propiedades";

// Consultar la BD
$stmt = $db->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll( PDO::FETCH_ASSOC );

echo "<pre>";
foreach($resultado as $propiedad){
	echo $propiedad['titulo'], "<br>";
	echo $propiedad['imagen'], "<br>";
}
//var_dump($resultado);
echo "</pre>";

include 'includes/footer.php';